<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Kendaraan;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dadshboard\Kendaraan\StoreUnitKendaraanRequest;
use App\Http\Requests\Dashboard\Kendaraan\DeleteKendaraanRequest;
use App\Http\Requests\Dashboard\Kendaraan\DeleteUnitKendaraanRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Kendaraan\KendaraanRequest;
use App\Http\Requests\Dashboard\Kendaraan\StoreKendaraanRequest;
use App\Http\Requests\Dashboard\Kendaraan\UpdateKendaraanRequest;
use App\Http\Requests\Dashboard\Kendaraan\UpdateUnitKendaraanRequest;
use App\Models\UnitKendaraan;

class KendaraanController extends Controller
{
    /**
     * Menampilkan halaman data kendaraan.
     *
     * @param KendaraanRequest $request
     * @return View|JsonResponse
     */
    public function index(KendaraanRequest $request): View|JsonResponse
    {
        /**
         * Jika request berupa ajax.
         * Kemablikan response datatable.
         */
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.kendaraan.index');
    }

    /**
     * Menampilkan halaman tambah kendaraan baru.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.dashboard.kendaraan.create');
    }

    /**
     * Tambah data kendaraan ke database.
     *
     * @param StoreKendaraanRequest $request
     * @return RedirectResponse
     */
    public function store(StoreKendaraanRequest $request): RedirectResponse
    {
        return to_route('dashboard.kendaraan.unit', ['kendaraan' => $request->insert()])
            ->with('alert', [
                'variant' => 'success',
                'message' => 'Data kendaraan berhasil ditambahkan. Silahkan tambahkan data unit kendaraan.'
            ]);
    }

    /**
     * Menampilkan halaman edit kendaraan.
     *
     * @param Kendaraan $kendaraan
     * @return View
     */
    public function edit(Kendaraan $kendaraan): View
    {
        return view('pages.dashboard.kendaraan.edit', compact('kendaraan'));
    }

    /**
     * Perbarui data kendaraan di database.
     *
     * @param UpdateKendaraanRequest $request
     * @param Kendaraan $kendaraan
     * @return RedirectResponse
     */
    public function update(UpdateKendaraanRequest $request, Kendaraan $kendaraan): RedirectResponse
    {
        $request->update();

        return to_route('dashboard.kendaraan')->with('alert', [
            'variant' => 'success',
            'message' => 'Kendaraan berhasil diperbarui.',
        ]);
    }

    /**
     * Hapus kendaraan dari database.
     *
     * @param DeleteKendaraanRequest $request
     * @param Kendaraan $kendaraan
     * @return RedirectResponse
     */
    public function destroy(DeleteKendaraanRequest $request, Kendaraan $kendaraan): RedirectResponse
    {
        try {
            $request->destroy();
        } catch (\Throwable $e) {

            /**
             * Kirimkan pesan notifikasi untuk pembatalan penghapusan.
             */
            return back()->with('alert', [
                'variant' => 'warning',
                'message' => $e->getMessage(),
            ]);
        }

        return to_route('dashboard.kendaraan')->with('alert', [
            'variant' => 'success',
            'message' => 'Kendaraan berhasil dihapus.',
        ]);
    }

    /**
     * Menampilkan halaman tambah unit kendaraan
     *
     * @param Kendaraan $kendaraan
     * @return View
     */
    public function unit(Kendaraan $kendaraan)
    {
        return view('pages.dashboard.kendaraan.unit.index', [
            'kendaraan' => $kendaraan->load('unitKendaraan')
        ]);
    }

    /**
     * Tambah unit kendaraan ke database.
     *
     * @param StoreUnitKendaraanRequest $request
     * @param Kendaraan $kendaraan
     * @return RedirectResponse
     */
    public function storeUnit(StoreUnitKendaraanRequest $request, Kendaraan $kendaraan): RedirectResponse
    {
        $request->insert();

        return to_route('dashboard.kendaraan.unit', ['kendaraan' => $kendaraan->id])
            ->with('alert', [
                'variant' => 'success',
                'message' => 'Unit kendaraan berhasil ditambahkan.'
            ]);
    }

    /**
     * Hapus unit kendaraan dari database.
     *
     * @param DeleteUnitKendaraanRequest $request
     * @param Kendaraan $kendaraan
     * @param UnitKendaraan $unit
     * @return RedirectResponse
     */
    public function destroyUnit(DeleteUnitKendaraanRequest $request, Kendaraan $kendaraan, UnitKendaraan $unit): RedirectResponse
    {
        try {
            $request->destroy();
        } catch (\Throwable $e) {

            /**
             * Kirimkan pesan notifikasi untuk pembatalan penghapusan.
             */
            return back()->with('alert', [
                'variant' => 'warning',
                'message' => $e->getMessage(),
            ]);
        }

        /**
         * Kirimkan pesan notifikasi jika penghapusan berhasil.
         */
        return to_route('dashboard.kendaraan.unit', ['kendaraan' => $kendaraan->id])
            ->with('alert', [
                'variant' => 'success',
                'message' => 'Unit kendaraan berhasil dihapus.'
            ]);
    }

    /**
     * Perbarui data unit kendaraan
     *
     * @param UpdateUnitKendaraanRequest $request
     * @param Kendaraan $kendaraan
     * @param UnitKendaraan $unit
     * @return RedirectResponse
     */
    public function updateUnit(UpdateUnitKendaraanRequest $request, Kendaraan $kendaraan, UnitKendaraan $unit): RedirectResponse
    {
        $request->update();

        return to_route('dashboard.kendaraan.unit', ['kendaraan' => $kendaraan->id])
            ->with('alert', [
                'variant' => 'success',
                'message' => 'Unit kendaraan berhasil diperbarui.'
            ]);
    }
}
