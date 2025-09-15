<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User as User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registerUser(Request $request)
    {
        if (!$this->allInputsFilled($request))
            return redirect()->back()->withInput()->withErrors(['msg' => 'Not all inputs are filled']);

        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'number' => ['required', 'unique:users'],
        ], [
            'email.unique'   => 'That email is already registered.',
            'number.unique'   => 'That number is already registered.',
        ]);

        if (!str_contains($request->input('email'), 'hu.nl'))
            return redirect()->back()->withInput()->withErrors(['msg' => 'Must be a HU email']);

        if ($request->input('password') !== $request->input('confirmPassword'))
            return redirect()->back()->withInput()->withErrors(['msg' => 'Passwords do not match']);

        try {
            $user = new User;

            $user->firstName = $request->input('firstName');
            $user->lastName = $request->input('lastName');
            $user->tribe = $request->input('tribe');
            $user->number = $request->input('number');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));

            $user->save();

            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/'); // TODO: change to queue page when we have that
            }

            return view('user/login');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function loginUser(Request $request)
    {
        if (!$this->allInputsFilled($request))
            return redirect()->back()->withInput()->withErrors(['msg' => 'Not all inputs are filled']);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // TODO: change to queue page when we have that
        }

        return redirect()->back()->onlyInput('email')->withErrors(['msg' => 'The provided credentials do not match our records.']);
    }

    public function allInputsFilled(Request $request): bool
    {
        foreach ($request->all() as $name => $value)
            if (is_null($value) || empty($value))
                return false;

        return true;
    }
}
