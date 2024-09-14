<?php

namespace App\Http\Controllers;

use App\Http\Requests\Main\Pesanan\BuktiPembayaranPesananRequest;
use App\Models\Pesanan;
use Illuminate\Http\RedirectResponse;
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
         * Update status pesanan yang sudah dikonfirmasi menjadi selesai jika tanggal saat ini
         * sudah melewati tanggal keberangkatan dan tanggal kepulangan.
         */
        Pesanan::where('user_id', user()->id)
            ->where('status', 'Dikonfirmasi')
            ->where('tanggal_keberangkatan', '<', date('Y-m-d'))
            ->where('tanggal_kepulangan', '<', date('Y-m-d'))
            ->update(['status' => 'Selesai']);

        /**
         * Select data pesanan berserta detailnya.
         */
        $pesanan = Pesanan::with(['destinasi'])
            ->where('user_id', user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.main.pesanan.index', compact('pesanan'));
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

    /**
     * Upload bukti pembayaran pesanan.
     *
     * @return void
     */
    public function uploadBuktiPembayaran(BuktiPembayaranPesananRequest $request, Pesanan $pesanan): RedirectResponse
    {
        $request->update();

        return to_route('main.pesanan.show', ['pesanan' => $pesanan->id])->with('alert', [
            'variant' => 'success',
            'message' => 'Bukti pembayaran berhasil diunggah.'
        ]);
    }
}
