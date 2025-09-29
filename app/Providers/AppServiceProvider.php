<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Waarheen je users wilt sturen na login.
     */
    public const HOME = '/dashboard';

    public function boot(): void
    {
        // Geen extra configuratie nodig voor nu.
        // (Hier kun je eventueel route model binding e.d. doen.)
    }
}
