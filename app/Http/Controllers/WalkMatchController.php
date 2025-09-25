<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WalkMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class WalkMatchController extends Controller
{
    public function createMatch(Request $request)
    {
        $user1 = User::find(Auth::id());
        $user2 = User::find($request->input('otherUserId'));

        $user1->queue()->delete();
        $user2->queue()->delete();

        $walkMatch = new WalkMatch();
        $walkMatch->user_id_1 = $user1->id;
        $walkMatch->user_id_2 = $user2->id;

        $walkMatch->save();
    }
}
