<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Harga;
use App\Models\Paket;
use App\Models\Kendaraan;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Harga\DeleteHargaRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Harga\HargaRequest;
use App\Http\Requests\Dashboard\Harga\StoreHargaRequest;
use App\Http\Requests\Dashboard\Harga\UpdateHargaRequest;

class HargaController extends Controller
{
    /**
     * Menampilkan halaman daftar harga.
     *
     * @param HargaRequest $request
     * @return JsonResponse|View
     */
    public function index(HargaRequest $request): JsonResponse|View
    {
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.harga.index');
    }

    /**
     * Menampilkan halaman tambah harga
     *
     * @return View
     */
    public function create(): View
    {
        /**
         * Select data kendaraan
         */
        $kendaraan = Kendaraan::select('id', 'merek', 'tipe')
            ->orderBy('merek', 'asc')
            ->get();

        /**
         * Select data paket dan destinasi.
         */
        $paket = Paket::with(['destinasi'])
            ->select('id', 'nama')
            ->where('aktif', true)
            ->orderBy('nama', 'asc')
            ->get();

        return view('pages.dashboard.harga.create', compact('kendaraan', 'paket'));
    }

    /**
     * Insert data harga ke database.
     *
     * @param StoreHargaRequest $request
     * @return RedirectResponse
     */
    public function store(StoreHargaRequest $request): RedirectResponse
    {
        $request->insert();

        return to_route('dashboard.harga.create')->with('alert', [
            'variant' => 'success',
            'message' => 'Harga berhasil ditambahkan.'
        ]);
    }

    /**
     * Menampilkan halaman tambah harga
     *
     * @return View
     */
    public function edit(Harga $harga): View
    {
        /**
         * Select data kendaraan
         */
        $kendaraan = Kendaraan::select('id', 'merek', 'tipe')
            ->orderBy('merek', 'asc')
            ->get();

        /**
         * Select data paket dan destinasi.
         */
        $paket = Paket::with(['destinasi'])
            ->select('id', 'nama')
            ->where('aktif', true)
            ->orderBy('nama', 'asc')
            ->get();

        return view('pages.dashboard.harga.edit', compact('harga', 'kendaraan', 'paket'));
    }

    /**
     * Update data harga di database.
     *
     * @param UpdateHargaRequest $request
     * @param Harga $harga
     * @return RedirectResponse
     */
    public function update(UpdateHargaRequest $request, Harga $harga): RedirectResponse
    {
        $request->update();

        return to_route('dashboard.harga')->with('alert', [
            'variant' => 'success',
            'message' => 'Harga berhasil diperbarui.'
        ]);
    }

    /**
     * Delete 
     *
     * @param DeleteHargaRequest $request
     * @param Harga $harga
     * @return RedirectResponse
     */
    public function destroy(DeleteHargaRequest $request, Harga $harga): RedirectResponse
    {
        try {
            $request->destroy();
        } catch (\Throwable $e) {

            /**
             * Kirimkan pesan kesalahan jika proses penghapusan gagal
             */
            return back()->with('alert', [
                'variant' => 'warning',
                'message' => $e->getMessage(),
            ]);
        }

        /**
         * Pesan jika proses penghapusan berhasil.
         */
        return to_route('dashboard.harga')->with('alert', [
            'variant' => 'success',
            'message' => 'Harga berhasil dihapus.',
        ]);
    }
}
