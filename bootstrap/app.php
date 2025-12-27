<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        /**
         * Kalau nanti kamu butuh middleware global / group / alias,
         * taruh di sini.
         *
         * Contoh (opsional):
         *
         * $middleware->alias([
         *     'isAdmin' => \App\Http\Middleware\IsAdmin::class,
         * ]);
         */
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        /**
         * Custom exception handling (opsional)
         */
    })
    ->create();
