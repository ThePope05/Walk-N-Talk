<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::name('user.')->group(function() {
    Route::get('user/login', function() {
        return view('user/login');
    })->name('login');
    Route::post('user/login', [UserController::class, 'loginUser'])->name('login');

    Route::get('user/register', function() {
        return view('user/register');
    })->name('register');
    Route::post('user/register', [UserController::class, 'registerUser'])->name('register');

    Route::get('user/logout', function() {
        if (Auth::check())
            Auth::logout();
        
        return redirect('/');
    })->name('logout');
});

Route::get('/questions/{category}', [QuestionController::class, 'show'])
    ->name('questions.show');