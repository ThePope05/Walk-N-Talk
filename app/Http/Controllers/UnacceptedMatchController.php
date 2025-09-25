<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UnacceptedMatch;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class UnacceptedMatchController extends Controller
{
    public function getEntries(string $id)
    {
        return DB::table('unaccepted_matches')
            ->where('user_id_1', '=', $id)
            ->orWhere('user_id_2', '=', $id)
            ->count('id') ?? 0;
    }

    public function createMatch(Request $request)
    {
        $user1 = User::find(Auth::id());
        $user2 = User::find($request->input('otherUserId'));

        $user1->queue()->delete();
        $user2->queue()->delete();

        $unacceptedMatch = new UnacceptedMatch();
        $unacceptedMatch->user_id_1 = $user1->id;
        $unacceptedMatch->user_id_2 = $user2->id;

        $unacceptedMatch->save();
    }

    public function acceptMatch(Request $request)
    {
        $id = $request->input('user_id');

        $whereFirst =  DB::table('unaccepted_matches')
            ->where('user_id_1', '=', $id)
            ->first();

        $whereSecond =  DB::table('unaccepted_matches')
            ->where('user_id_2', '=', $id)
            ->first();

        $isFirstUser = ($whereFirst != null);

        if ($isFirstUser)
            $whereFirst->user_1_accepted = true;
        else
            $whereSecond->user_2_accepted = true;
    }

    public function checkMatch()
    {

        return;
    }
}
