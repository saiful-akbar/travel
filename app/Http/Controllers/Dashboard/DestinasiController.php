<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Paket;
use App\Models\Destinasi;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Destinasi\DeleteDestinasiRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Destinasi\DestinasiRequest;
use App\Http\Requests\Dashboard\Destinasi\StoreDestinasiRequest;
use App\Http\Requests\Dashboard\Destinasi\UpdateDestinasiRequest;

class DestinasiController extends Controller
{
    /**
     * Menampilkan halaman daftar destinasi.
     *
     * @param DestinasiRequest $request
     * @return JsonResponse|View
     */
    public function index(DestinasiRequest $request): JsonResponse|View
    {
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.destinasi.index');
    }

    /**
     * Menampilkan halaman tambah data destinasi.
     *
     * @return View
     */
    public function create(): View
    {
        /**
         * select data id dan nama paket
         */
        $paket = Paket::select('id', 'nama')
            ->orderBy('nama', 'asc')
            ->get();

        return view('pages.dashboard.destinasi.create', compact('paket'));
    }

    /**
     * Insert data destinasi.
     *
     * @param StoreDestinasiRequest $request
     * @return RedirectResponse
     */
    public function store(StoreDestinasiRequest $request): RedirectResponse
    {
        $request->insert();

        return to_route('dashboard.destinasi.create')->with('alert', [
            'variant' => 'success',
            'message' => 'Destinasi berhasil ditambahkan.'
        ]);
    }

    /**
     * Menampilkan halaman edit destinasi.
     *
     * @param Destinasi $destinasi
     * @return View
     */
    public function edit(Destinasi $destinasi): View
    {
        $paket = Paket::select('id', 'nama')
            ->orderBy('nama', 'asc')
            ->get();

        return view('pages.dashboard.destinasi.edit', compact('destinasi', 'paket'));
    }

    /**
     * Update data destinasi.
     *
     * @param UpdateDestinasiRequest $request
     * @param Destinasi $destinasi
     * @return RedirectResponse
     */
    public function update(UpdateDestinasiRequest $request, Destinasi $destinasi): RedirectResponse
    {
        $request->update();

        return to_route('dashboard.destinasi')->with('alert', [
            'variant' => 'success',
            'message' => 'Destinasi berhasil diperbarui.'
        ]);
    }

    /**
     * Hapus data destinasi.
     *
     * @param DeleteDestinasiRequest $request
     * @param Destinasi $destinasi
     * @return RedirectResponse
     */
    public function destroy(DeleteDestinasiRequest $request, Destinasi $destinasi): RedirectResponse
    {
        try {
            $request->destroy();
        } catch (\Throwable $e) {
            /**
             * Tampilkan pesan error jika proses delete gagal.
             */
            return to_route('dashboard.destinasi')->with('alert', [
                'variant' => 'warning',
                'message' => $e->getMessage(),
            ]);
        }

        /**
         * Delete berhasil
         */
        return to_route('dashboard.destinasi')->with('alert', [
            'variant' => 'success',
            'message' => 'Destinasi berhasil dihapus.',
        ]);
    }
}
