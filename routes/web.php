<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/**
 * Auth
 */
Route::controller(AuthController::class)->group(function (): void {
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/login', 'store')->name('login.store')->middleware('guest');
    Route::delete('/logout', 'logout')->name('logout')->middleware('auth');
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
