<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Blade::component('layouts.app', 'app-layout');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
