<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/**
 * Auth
 */
Route::controller(AuthController::class)->group(function (): void {

    /**
     * Login dan register
     */
    Route::middleware('guest')->group(function (): void {
        Route::name('login')->prefix('/login')->group(function (): void {
            Route::get('/', 'login');
            Route::post('/', 'store')->name('.store');
        });

        Route::name('register')->prefix('/register')->group(function (): void {
            Route::get('/', 'register');
            Route::post('/', 'storeMember')->name('.store');
        });
    });

    /**
     * Logout
     */
    Route::middleware('auth')->group(function (): void {
        Route::delete('/logout', 'logout')->name('logout');
    });
});

/**
 * main
 */
Route::name('main')->group(function (): void {
    require_once __DIR__ . '/main.php';
});

/**
 * auth dashboard
 */
Route::middleware(['auth', 'role:admin'])
    ->name('dashboard')
    ->prefix('/dashboard')
    ->group(function (): void {
        require_once __DIR__ . '/dashboard.php';
    });
