<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TentangKamiController;

Route::get('/', [HomeController::class, 'index'])->name('.home');
Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('.tentangKami');
Route::get('/layanan', [LayananController::class, 'index'])->name('.layanan');

/**
 * Auth member
 */
Route::middleware(['auth', 'role:member'])->group(function (): void {

    /**
     * Pemesanan
     */
    Route::controller(PemesananController::class)
        ->name('.pemesanan')
        ->prefix('/pemesanan')
        ->group(function (): void {
            Route::get('/', 'index');
            Route::post('/', 'store')->name('.store');

            /**
             * Json response.
             */
            Route::name('.json')
                ->prefix('/json')
                ->group(function (): void {
                    Route::get('/destinasi/{paket}', 'getDestinasiJson')->name('.destinasi');
                    Route::get('/ketersediaan', 'cekKetersediaanKendaraan')->name('.ketersediaan');
                    Route::get('/harga', 'cekHarga')->name('.harga');
                });
        });
});
