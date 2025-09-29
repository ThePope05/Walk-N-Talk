<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::name('user.')->group(function () {

    // Login/Registratie
    Route::get('user/login', fn() => view('user.login'))->name('login');
    Route::post('user/login', [UserController::class, 'loginUser'])->name('login');

    Route::get('user/register', fn() => view('user.register'))->name('register');
    Route::post('user/register', [UserController::class, 'registerUser'])->name('register');

    // Logout
   // Verwijder of laat deze GET route staan (optioneel)
Route::get('user/logout', function () {
    if (Auth::check()) {
        Auth::logout();
    }
    return redirect('/');
});

// Voeg deze POST route toe
Route::post('user/logout', function () {
    if (Auth::check()) {
        Auth::logout();
    }
    return redirect('/');
})->name('logout');


    // ✅ Beveiligde routes
    Route::middleware('auth')->group(function () {

        // Profiel bekijken
    Route::get('user/profile', fn() => view('user.profile'))->name('profile');

// PUT: Update profiel
Route::put('user/profile', function (Request $request) {
    $user = Auth::user();

    $validated = $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName'  => 'required|string|max:255',
        'tribe'     => 'nullable|string|max:255',
        'number'    => 'required|string|max:255',
        'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
    ]);

    $user->update($validated);

    return redirect()->route('user.profile')->with('success', 'Profiel succesvol bijgewerkt!');
})->name('profile.update');
    });
});
