<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as User;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    public static function userIsQueued(int $id)
    {
        $user = User::find($id);
        return $user->queue()->exists();
    }

    public function queueStart()
    {
        $user = User::find(Auth::user()->id);
        $user->tryStartQueue();
        return redirect(route('welcome'));
    }

    public function queueStop()
    {
        $user = User::find(Auth::user()->id);
        $user->tryStopQueue();
        return redirect(route('welcome'));
    }
}
