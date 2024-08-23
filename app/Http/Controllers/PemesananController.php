<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PemesananController extends Controller
{
    /**
     * Menampilkan halaman pemesanan.
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.main.pemesanan.index');
    }
}
