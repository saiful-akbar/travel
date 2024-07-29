<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DestinasiController;
use App\Http\Controllers\Dashboard\HargaController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\KendaraanController;
use App\Http\Controllers\Dashboard\PerusahaanController;
use App\Http\Controllers\Dashboard\SupirController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\PaketController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

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
    Route::get('/', function (): RedirectResponse {
        return redirect()->route('login');
    });
});

/**
 * Auth member
 */
Route::middleware(['auth', 'role:member'])->name('name')->group(function (): void {
    // route auth main... 
});

/**
 * auth dashboard
 */
Route::middleware(['auth', 'role:admin'])
    ->name('dashboard')
    ->prefix('/dashboard')
    ->group(function (): void {

        Route::controller(HomeController::class)
            ->name('.home')
            ->group(function (): void {
                Route::get('/', 'index');
            });

        Route::controller(UserController::class)
            ->name('.user')
            ->prefix('/user')
            ->group(function (): void {
                Route::get('/', 'index');
                Route::get('/create', 'create')->name('.create');
                Route::post('/', 'store')->name('.store');
                Route::get('/{user}', 'edit')->name('.edit');
                Route::patch('/{user}', 'update')->name('.update');
                Route::delete('/{user}', 'destroy')->name('.destroy');
            });

        Route::controller(SupirController::class)
            ->name('.supir')
            ->prefix('/supir')
            ->group(function (): void {
                Route::get('/', 'index');
                Route::get('/create', 'create')->name('.create');
                Route::post('/', 'store')->name('.store');
                Route::get('/{supir}', 'edit')->name('.edit');
                Route::patch('/{supir}', 'update')->name('.update');
                Route::delete('/{supir}', 'destroy')->name('.destroy');
            });

        Route::controller(KendaraanController::class)
            ->name('.kendaraan')
            ->prefix('/kendaraan')
            ->group(function (): void {
                Route::get('/', 'index');
                Route::get('/create', 'create')->name('.create');
                Route::post('/', 'store')->name('.store');
                Route::get('/{kendaraan}', 'edit')->name('.edit');
                Route::patch('/{kendaraan}', 'update')->name('.update');
                Route::delete('/{kendaraan}', 'destroy')->name('.destroy');

                Route::name('.unit')->prefix('/{kendaraan}/unit')->group(function (): void {
                    Route::get('/', 'unit');
                    Route::post('/', 'storeUnit')->name('.store');
                    Route::patch('/{unit}', 'updateUnit')->name('.update');
                    Route::delete('/{unit}', 'destroyUnit')->name('.destroy');
                });
            });

        Route::controller(PerusahaanController::class)
            ->name('.perusahaan')
            ->prefix('/perusahaan')
            ->group(function (): void {
                Route::get('/', 'index');
                Route::post('/', 'store')->name('.store');
            });

        Route::controller(PaketController::class)
            ->name('.paket')
            ->prefix('/paket')
            ->group(function (): void {
                Route::get('/', 'index');
                Route::get('/crete', 'create')->name('.create');
                Route::post('/', 'store')->name('.store');
                Route::get('/{paket}', 'edit')->name('.edit');
                Route::patch('/{paket}', 'update')->name('.update');
                Route::delete('/{paket}', 'destroy')->name('.destroy');
            });

        Route::controller(DestinasiController::class)
            ->name('.destinasi')
            ->prefix('/destinasi')
            ->group(function (): void {
                Route::get('/', 'index');
                Route::get('/create', 'create')->name('.create');
                Route::post('/', 'store')->name('.store');
                Route::get('/{destinasi}', 'edit')->name('.edit');
                Route::patch('/{destinasi}', 'update')->name('.update');
                Route::delete('/{destinasi}', 'destroy')->name('.destroy');
            });

        Route::controller(HargaController::class)
            ->name('.harga')
            ->prefix('/harga')
            ->group(function (): void {
                Route::get('/', 'index');
                Route::get('/create', 'create')->name('.create');
                Route::post('/', 'store')->name('.store');
                Route::get('/{harga}', 'edit')->name('.edit');
                Route::patch('/{harga}', 'update')->name('.update');
                Route::delete('/{harga}', 'destroy')->name('.destroy');
            });
    });
