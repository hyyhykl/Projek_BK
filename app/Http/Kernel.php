<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     */
    protected $middleware = [
        // Handles CORS preflight requests
        \Illuminate\Http\Middleware\HandleCors::class,

        // Ensures the application is using the correct environment
        \Fruitcake\Cors\HandleCors::class,
    ];

    /**
     * The application's route middleware groups.
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Route middleware untuk dipanggil di route.
     */
    protected $routeMiddleware = [
        'auth'          => \App\Http\Middleware\Authenticate::class,
        'guest'         => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified'      => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // Kita tambahkan custom role middleware di sini
        'role'          => \App\Http\Middleware\RoleMiddleware::class,
    ];
}