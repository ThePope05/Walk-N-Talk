<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as User;
use App\Models\Queue as Queue;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    public static function userIsQueued(int $id)
    {
        $user = User::find($id);
        return $user->queue()->exists();
    }

    public static function userQueuedAt(int $id)
    {
        $user = User::find($id);

        if ($user->queue()->exists())
            return $user->queue->created_at;
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

    // app/Http/Controllers/QueueController.php
    public function getEntries()
    {
        $entries = Queue::with('user')->where('user_id', '!=', Auth::id())->get();
        return response()->json($entries);
    }
}
