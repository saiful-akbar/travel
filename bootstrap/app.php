<?php

use Illuminate\Http\Request;
use App\Http\Middleware\HasRole;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        /**
         * Redirect jika route mmeiliki middleware guest.
         */
        $middleware->redirectUsersTo(function (Request $request): string {
            if ($request->user()->role == 'admin') {
                return route('dashboard.home');
            }

            return route('main.home');
        });

        /**
         * Middleware alias.
         */
        $middleware->alias([
            'role' => HasRole::class,
            'Excel' => Excel::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
