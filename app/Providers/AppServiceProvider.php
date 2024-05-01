<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

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
        //
    }

    protected function registerMiddlewareAliases(): void
    {
        Route::middlewareGroup('role', [RoleMiddleware::class]);
        Route::middlewareGroup('permission', [PermissionMiddleware::class]);
        Route::middlewareGroup('role-or-permission', [RoleOrPermissionMiddleware::class]);
    }
}
