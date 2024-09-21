<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Pesanan;
use App\Models\Tagihan;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Pesanan\PesananRequest;
use App\Http\Requests\Dashboard\Pembayaran\KonfirmasiTagihanPembayaranRequest;

class PesananController extends Controller
{
    /**
     * Menampilkan halaman daftar pesanan pada dashboard.
     *
     * @param PesananRequest $request
     * @return View|JsonResponse
     */
    public function index(PesananRequest $request): View|JsonResponse
    {
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.pesanan.index');
    }

    /**
     * Mengambil data bukti pembayaran pesanan.
     *
     * @param Tagihan $tagihan
     * @return JsonResponse
     */
    public function getBuktiPembayaran(Tagihan $tagihan): JsonResponse
    {
        return response()->json([
            'data' => $tagihan
        ]);
    }

    /**
     * Konfirmasi bukti pembayaran pesanan.
     *
     * @param KonfirmasiTagihanPembayaranRequest $request
     * @param Tagihan $tagihan
     * @return RedirectResponse
     */
    public function konfirmasiTagihanPembayaran(KonfirmasiTagihanPembayaranRequest $request, Tagihan $tagihan): RedirectResponse
    {
        $request->update();
        return to_route('dashboard.pesanan');
    }

    /**
     * Menampilkan halaman detail pesanan
     *
     * @param Pesanan $pesanan
     * @return View
     */
    public function show(Pesanan $pesanan): View
    {
        return view('pages.dashboard.pesanan.show', [
            'pesanan' => $pesanan->load([
                'user',
                'supir',
                'unitKendaraan.kendaraan',
                'destinasi.paket',
                'tagihan',
            ]),
        ]);
    }
}
