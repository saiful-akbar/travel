<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman home.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * Select data paket yang memilki status aktif.
         */
        $paket = Paket::where('aktif', true)
            ->orderBy('nama', 'asc')
            ->get();

        return view('pages.main.home.index', compact('paket'));
    }
}
