<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gunakan Tailwind untuk paginasi
        Paginator::useTailwind();

        // Buat gate "admin"
        Gate::define('admin', function ($user) {
            return $user->is_admin === true;
        });

        // Custom model token untuk Sanctum
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        // Konfigurasi dokumentasi API (Scramble)
        Scramble::configure()->routes(function (Route $route) {
            return Str::startsWith($route->uri, 'api/');
        });
    }
}
