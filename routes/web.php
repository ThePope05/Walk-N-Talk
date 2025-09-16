<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\QueueController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::user())
        return view('welcome', ['userIsQueueing' => QueueController::userIsQueued(Auth::user()->id)]);

    return view('welcome');
})->name('welcome');


// LOGIN ROUTES
Route::get('user/login', function() {
    return view('user/login');
})->name('login');
Route::post('user/login', [UserController::class, 'loginUser'])->name('login');

// REGISTER ROUTES
Route::get('user/register', function() {
    return view('user/register');
})->name('register');
Route::post('user/register', [UserController::class, 'registerUser'])->name('register');

Route::get('user/logout', function() {
    if (Auth::check())
        Auth::logout();
    
    return redirect('/');
})->name('logout');

// QUEUE ROUTES
Route::get('user/queue/start', [QueueController::class, 'queueStart'])->middleware('auth')->name('queue.start');
Route::get('user/queue/stop', [QueueController::class, 'queueStop'])->middleware('auth')->name('queue.stop');
