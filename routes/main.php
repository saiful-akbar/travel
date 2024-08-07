<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TentangKamiController;

Route::get('/', [HomeController::class, 'index'])->name('.home');
Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('.tentangKami');
Route::get('/layanan', [LayananController::class, 'index'])->name('.layanan');
