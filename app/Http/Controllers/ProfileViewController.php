<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileViewController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();             // ingelogde user
        return view('profile.show', compact('user'));  // >>> profile/show.blade.php
    }
}
