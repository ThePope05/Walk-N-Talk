<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as User;
use App\Models\Queue as Queue;
use Exception;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    public static function isQueueing()
    {
        $user = User::find(Auth::id());
        return response()->json($user->queue()->exists());
    }

    public static function userQueuedAt()
    {
        $user = User::find(Auth::id());

        if ($user->queue()->exists()) {
            $time_stamp = $user->queue->created_at;
            return response()->json($time_stamp);
        }
    }

    public static function queueStart()
    {
        try {
            $user = User::find(Auth::id());
            $user->tryStartQueue();
            return response();
        } catch (Exception $e) {
            return response($e, 500);
        }
    }

    public static function queueStop()
    {
        try {
            $user = User::find(Auth::id());
            $user->tryStopQueue();
            return response();
        } catch (Exception $e) {
            return response($e, 500);
        }
    }

    // app/Http/Controllers/QueueController.php
    public function getEntries()
    {
        $entries = Queue::with('user')->where('user_id', '!=', Auth::id())->get();
        return response()->json($entries);
    }
}
