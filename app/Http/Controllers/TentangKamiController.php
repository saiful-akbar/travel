<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class TentangKamiController extends Controller
{
    /**
     * Menampilkan halaman tentang kami
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.main.tentang-kami.index');
    }
}
