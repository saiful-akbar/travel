<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\HargaController;
use App\Http\Controllers\Dashboard\PaketController;
use App\Http\Controllers\Dashboard\SupirController;
use App\Http\Controllers\Dashboard\DestinasiController;
use App\Http\Controllers\Dashboard\JadwalController;
use App\Http\Controllers\Dashboard\KendaraanController;
use App\Http\Controllers\Dashboard\MediaSosialController;
use App\Http\Controllers\Dashboard\PerusahaanController;
use App\Http\Controllers\Dashboard\PesananController;

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
    ->prefix('/user')
    ->group(function (): void {
        Route::get('/', 'index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');
        Route::get('/{user}', 'edit')->name('.edit');
        Route::patch('/{user}', 'update')->name('.update');
        Route::delete('/{user}', 'destroy')->name('.destroy');
    });

/**
 * Supir
 */
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

/**
 * Kendaraan
 */
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

        Route::name('.unit')
            ->prefix('/{kendaraan}/unit')
            ->group(function (): void {
                Route::get('/', 'unit');
                Route::post('/', 'storeUnit')->name('.store');
                Route::patch('/{unit}', 'updateUnit')->name('.update');
                Route::delete('/{unit}', 'destroyUnit')->name('.destroy');
            });
    });

/**
 * Perusahaan
 */
Route::controller(PerusahaanController::class)
    ->name('.perusahaan')
    ->prefix('/perusahaan')
    ->group(function (): void {
        Route::get('/', 'index');
        Route::post('/', 'store')->name('.store');
    });

/**
 * Paket
 */
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

/**
 * Destinasi
 */
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

/**
 * Harga
 */
Route::controller(HargaController::class)
    ->name('.harga')
    ->prefix('/harga')
    ->group(function (): void {
        Route::get('/', 'index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');
        Route::get('/{harga}/edit', 'edit')->name('.edit');
        Route::patch('/{harga}', 'update')->name('.update');
        Route::delete('/{harga}', 'destroy')->name('.destroy');

        Route::name('.json')->prefix('/json')->group(function (): void {
            Route::get('/paket/{paket}/destinasi', 'getDestinasi')->name('.paket.destinasi');
        });
    });

/**
 * Media Sosial
 */
Route::controller(MediaSosialController::class)
    ->name('.mediaSosial')
    ->prefix('/media-sosial')
    ->group(function (): void {
        Route::get('/', 'index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');
        Route::get('/{mediaSosial}', 'edit')->name('.edit');
        Route::patch('/{mediaSosial}', 'update')->name('.update');
        Route::delete('/{mediaSosial}', 'destroy')->name('.destroy');
    });

/**
 * Pesanan
 */
Route::controller(PesananController::class)
    ->name('.pesanan')
    ->prefix('/pesanan')
    ->group(function (): void {
        Route::get('/', 'index');
        Route::get('/{pesanan}', 'show')->name('.show');
        Route::patch('/tagihan/{tagihan}/konfirmasi-pembayaran', 'konfirmasiTagihanPembayaran')->name('.tagihan.konfirmasiPembayaran');
        Route::delete('/{pesanan}', 'destroy')->name('.destroy');

        Route::name('.json')->prefix('/json')->group(function (): void {
            Route::get('/tagihan/{tagihan}/bukti-pembayaran', 'getBuktiPembayaran')->name('.tagihan.buktiPembayaran');
        });
    });

/**
 * Jadwal
 */
Route::controller(JadwalController::class)
    ->name('.jadwal')
    ->prefix('/jadwal')
    ->group(function (): void {
        Route::get('/', 'index');
    });
