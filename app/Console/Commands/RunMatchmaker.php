<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\WalkMatch;

class RunMatchmaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-matchmaker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    public function handle()
    {
        echo "Daemon running...";
        // Keep looping if you want a long-running worker
        while (true) {
            echo $this->runMatchmakerCycle();

            // sleep 1-2 seconds to avoid hammering DB
            sleep(1);
        }
    }

    protected function runMatchmakerCycle()
    {
        DB::transaction(function () {
            // Grab 2 waiting players (locked for update)
            $queues = DB::table('queues')
                ->orderBy('created_at')
                ->limit(2)
                ->get();

            if ($queues->count() === 2) {
                // get id's
                $id2 = $queues[0]->user_id;
                $id1 = $queues[1]->user_id;

                // sort id's
                if ($id1 > $id2) {
                    $tmpId2 = $id2;
                    $id2 = $id1;
                    $id1 = $tmpId2;
                }

                // find users
                $user1 = User::find($id1);
                $user2 = User::find($id2);

                // if not delete all users queues
                $user1->queue()->delete();
                $user2->queue()->delete();

                // check existing match
                $existingMatch = DB::table('walk_matches')
                    ->where('user_id_1', $user1->id)
                    ->where('user_id_2', $user2->id)
                    ->where('completed', false)
                    ->first();

                // if there is an existing unfinished match return
                if (!is_null($existingMatch))
                    return;

                // and make new match
                $walkMatch = new WalkMatch();
                $walkMatch->user_id_1 = $user1->id;
                $walkMatch->user_id_2 = $user2->id;

                $walkMatch->save();

                echo "Made match...";
            }
        });
    }
}
