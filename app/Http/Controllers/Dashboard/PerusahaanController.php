<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\View\View;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Perusahaan\StorePerusahaanRequest;
use Illuminate\Http\RedirectResponse;

class PerusahaanController extends Controller
{
    /**
     * Menampilkan halaman profil perusahaan.
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.dashboard.perusahaan.index', [
            'perusahaan' => Perusahaan::first(),
        ]);
    }

    /**
     * Tambahkan atau ubah data perusahaan.
     *
     * @param StorePerusahaanRequest $request
     * @return RedirectResponse
     */
    public function store(StorePerusahaanRequest $request): RedirectResponse
    {
        /**
         * Jalankan proses insert data perusahaan.
         */
        $request->insert();

        /**
         * Jika insert berhasil alihkan kembali ke halmaan perusahaan
         * serta kirimkan notifikasi bahwa proses insert berhasil.
         */
        return to_route('dashboard.perusahaan')->with('alert', [
            'variant' => 'success',
            'message' => 'Data perusahaan berhasil diperbarui.'
        ]);
    }
}
