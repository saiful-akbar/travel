<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use DateTime;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * menampilkan halaman daftar pesanan user member.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * Select data pesanan berserta detailnya.
         */
        $pesanans = Pesanan::with(['destinasi'])
            ->where('user_id', user()->id)
            ->orderBy('created_at', 'desc')
            ->simplePaginate(10);

        return view('pages.main.pesanan.index', compact('pesanans'));
    }

    /**
     * Menampilkan halaman detail pesanan.
     *
     * @param Pesanan $pesanan
     * @return View
     */
    public function show(string $id): View
    {
        /**
         * Select data pesanan beserta detailnya
         */
        $pesanan = Pesanan::with(['unitKendaraan.kendaraan', 'destinasi', 'tagihan'])
            ->where('id', $id)
            ->where('user_id', user()->id)
            ->first();

        /**
         * Jika pesanan bernilai null tampilkan halaman 404.
         */
        if (is_null($pesanan)) {
            abort(404);
        }

        return view('pages.main.pesanan.show', compact('pesanan'));
    }
}
