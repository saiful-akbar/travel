<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Pesanan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Pesanan\PesananRequest;

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
     * Menampilkan halaman edit pesanan
     *
     * @param Pesanan $pesanan
     * @return View
     */
    public function edit(Pesanan $pesanan): View
    {
        return view('pages.dashboard.pesanan.edit', [
            'pesanan' => $pesanan->load([
                'user',
                'supir',
                'unitKendaraan.kendaraan',
                'destinasi',
                'tagihan',
            ]),
        ]);
    }

    public function update(Request $request)
    {
        dd($request->all());
    }
}
