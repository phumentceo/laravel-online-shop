<?php

use App\Http\Middleware\Admin\AdminMiddleware;
use App\Http\Middleware\Admin\AdminRedirect;
use App\Http\Middleware\User\UserMiddleware;
use App\Http\Middleware\User\UserRedirect;
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
            'guest.admin' => AdminRedirect::class,
            'auth.admin'  => AdminMiddleware::class,
            'guest.user' => UserRedirect::class,
            'auth.user'  => UserMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
