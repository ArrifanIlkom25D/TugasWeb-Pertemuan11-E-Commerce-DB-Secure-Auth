<?php
// Laravel 11/12: EDIT bootstrap/app.php bawaan, tambahkan alias middleware di bagian ->withMiddleware()
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class, // <-- TAMBAHKAN
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
