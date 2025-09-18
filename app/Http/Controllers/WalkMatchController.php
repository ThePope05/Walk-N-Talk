<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalkMatchController extends Controller
{
    public function createMatch(Request $request)
    {
        $user1 = User::find(Auth::id());
        $user2 = User::find($request->input('otherUserId'));

        $user1->queue()->delete();
        $user2->queue()->delete();

        return redirect(route('/'));
    }
}
