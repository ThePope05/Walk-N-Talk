<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileViewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Controllers\NoShowReportController;

// Publiek / basis
Route::get('/', fn () => view('welcome'));
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Auth routes (Breeze/Jetstream)
require __DIR__.'/auth.php';

// -------------------------
// Ingelogd (niet-admin)
// -------------------------
Route::middleware('auth')->group(function () {
    // Breeze profiel (bewerken)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // “Mijn profiel” READ-ONLY (nieuw, eigen pad + naam)
    Route::get('/me', [ProfileViewController::class, 'show'])->name('me.show');

    // Profielen (read-only + bewerken via policy)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->whereNumber('user')->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->whereNumber('user')->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->whereNumber('user')->name('users.update');
});

// -------------------------
// Admin only
// -------------------------
Route::middleware(['auth', EnsureUserIsAdmin::class])
    ->prefix('admin')->name('admin.')
    ->group(function () {
        // Gebruikersbeheer: lijst + detail (read-only view voor admin)
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UsersController::class, 'show'])
            ->whereNumber('user')->name('users.show');

        // A) Eén melding verwijderen
        Route::delete('/no-shows/{report}', [NoShowReportController::class, 'destroy'])
            ->name('no_shows.destroy');

        // B) Alle meldingen van een user verwijderen
        Route::delete('/users/{user}/no-shows', [NoShowReportController::class, 'destroyAllForUser'])
            ->whereNumber('user')
            ->name('users.no_shows.destroy_all');  
    });