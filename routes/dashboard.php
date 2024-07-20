<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserController;

/**
 * Home
 */
Route::controller(HomeController::class)
    ->name('.home')
    ->group(function (): void {
        Route::get('/', 'index');
    });

/**
 * User
 */
Route::controller(UserController::class)
    ->name('.user')
    ->prefix('user')
    ->group(function (): void {
        Route::get('/', 'index');
        Route::get('/datatable', 'dataTable')->name('.dataTable');
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');
        Route::get('/{user}/edit', 'edit')->name('.edit');
        Route::patch('/{user}', 'update')->name('.update');
        Route::delete('/{user}', 'destroy')->name('.destroy');
    });
