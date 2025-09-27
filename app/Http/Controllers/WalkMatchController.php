<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WalkMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalkMatchController extends Controller
{
    public function createMatch(Request $request)
    {
        // get id's
        $id1 = Auth::id();
        $id2 = $request->input('otherUserId');

        // sort id's
        if ($id1 > $id2)
        {
            $tmpId2 = $id2;
            $id2 = $id1;
            $id1 = $tmpId2;
        }

        // find users
        $user1 = User::find($id1);
        $user2 = User::find($id2);

        // check existing match
        $existingMatch = DB::table('walk_matches')
            ->where('user_id_1', $user1->id)
            ->where('user_id_2', $user2->id)
            ->where('completed', false)
            ->first();

        // if there is an existing unfinished match return
        if (!is_null($existingMatch))
            return;

        // if not delete all users queues
        $user1->queue()->delete();
        $user2->queue()->delete();

        // and make new match
        $walkMatch = new WalkMatch();
        $walkMatch->user_id_1 = $user1->id;
        $walkMatch->user_id_2 = $user2->id;

        $walkMatch->save();
    }

    public function hasUnfinishedWalk()
    {
        $existingMatch = DB::table('walk_matches')
            ->where(function ($query) {
                $query->where('user_id_1', Auth::id())
                    ->orWhere('user_id_2', Auth::id());
            })
            ->where('completed', false)
            ->first();

        return !is_null($existingMatch);
    }

    public function finishWalk()
    {
        return redirect('/');
    }
}
