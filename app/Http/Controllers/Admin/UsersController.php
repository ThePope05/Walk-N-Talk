<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $users = User::query()
            ->when($q, fn($query) => 
                $query->where('name', 'like', "%$q%")
                      ->orWhere('email', 'like', "%$q%")
            )
            ->paginate(10);

        return view('admin.users.index', compact('users', 'q'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
        $user->loadCount('noShowReportsReceived')
         ->load(['noShowReportsReceived' => fn($q) => $q->with('reporter')->latest()]);
    return view('admin.users.show', compact('user'));
    }
}
