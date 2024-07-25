<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\KendaraanController;
use App\Http\Controllers\Dashboard\PerusahaanController;
use App\Http\Controllers\Dashboard\SupirController;
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
 * Master User
 */
Route::controller(UserController::class)
    ->name('.user')
    ->prefix('/user')
    ->group(function (): void {
        Route::get('/', 'index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');
        Route::get('/{user}/edit', 'edit')->name('.edit');
        Route::patch('/{user}', 'update')->name('.update');
        Route::delete('/{user}', 'destroy')->name('.destroy');
    });

/**
 * Master Supir
 */
Route::controller(SupirController::class)
    ->name('.supir')
    ->prefix('/supir')
    ->group(function (): void {
        Route::get('/', 'index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');
        Route::get('/{supir}/edit', 'edit')->name('.edit');
        Route::patch('/{supir}', 'update')->name('.update');
        Route::delete('/{supir}', 'destroy')->name('.destroy');
    });

/**
 * Master Kendaraan
 */
Route::controller(KendaraanController::class)
    ->name('.kendaraan')
    ->prefix('/kendaraan')
    ->group(function (): void {
        Route::get('/', 'index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');
        Route::get('/{kendaraan}/edit', 'edit')->name('.edit');
        Route::patch('/{kendaraan}', 'update')->name('.update');
        Route::delete('/{kendaraan}', 'destroy')->name('.destroy');

        Route::name('.unit')
            ->prefix('/{kendaraan}/unit')
            ->group(function (): void {
                Route::get('/', 'unit');
                Route::post('/', 'storeUnit')->name('.store');
                Route::delete('/{unit}', 'destroyUnit')->name('.destroy');
            });
    });

/**
 * Master Perusahaan
 */
Route::controller(PerusahaanController::class)
    ->name('.perusahaan')
    ->prefix('/perusahaan')
    ->group(function (): void {
        Route::get('/', 'index');
        Route::post('/', 'store')->name('.store');
    });
