<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\WalkMatchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// LOGIN ROUTES
Route::get('user/login', function () {
    return view('user/login');
})->name('login');
Route::post('user/login', [UserController::class, 'loginUser'])->name('login');

// REGISTER ROUTES
Route::get('user/register', function () {
    return view('user/register');
})->name('register');
Route::post('user/register', [UserController::class, 'registerUser'])->name('register');

Route::get('user/logout', function () {
    if (Auth::check())
        Auth::logout();

    return redirect('/');
})->name('logout');

// API ENDPOINTS
Route::get('/queue/entries', [QueueController::class, 'getEntries']);
Route::get('/user/hasUnfinishedWalk', [WalkMatchController::class, 'hasUnfinishedWalk']);

Route::get('user/queue/start', [QueueController::class, 'queueStart'])->middleware('auth')->name('queue.start');
Route::get('user/queue/stop', [QueueController::class, 'queueStop'])->middleware('auth')->name('queue.stop');
Route::get('user/queue/isQueueing', [QueueController::class, 'isQueueing'])->middleware('auth')->name('user.isQueueing');
Route::get('user/queue/queuedAt', [QueueController::class, 'userQueuedAt'])->middleware('auth')->name('user.queuedAt');

Route::get('/user/online_count', [UserController::class, 'getUserCount']);

// START MATCH 
Route::post('/walkMatch', [WalkMatchController::class, 'createMatch']);

// MATCH PAGE
Route::get('/match', function () {
    return view('match-page');
})->name('match');

Route::get('/ice-breakers', function () {
    return view('ice-breakers');
})->name('ice-breakers');

Route::get('/questions/{category}', [QuestionController::class, 'show'])
    ->name('questions.show');

Route::get('/walk/end', [WalkMatchController::class, 'finishWalk'])->name('walk.end');
