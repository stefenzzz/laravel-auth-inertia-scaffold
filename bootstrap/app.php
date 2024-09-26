<?php

use App\Http\Middleware\Authenticated;
use App\Http\Middleware\EmailVerified;
use App\Http\Middleware\Guest;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\SignedVerification;
use App\Http\Middleware\UnverifiedEmail;
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
        $middleware->web([
            HandleInertiaRequests::class,
        ]);

        $middleware->alias([
            'guest' => Guest::class,
            'auth' => Authenticated::class,
            'verified' => EmailVerified::class,
            'unverified' => UnverifiedEmail::class,
            'signed' => SignedVerification::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
