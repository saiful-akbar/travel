<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Kendaraan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dadshboard\Kendaraan\StoreUnitKendaraanRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Kendaraan\KendaraanRequest;
use App\Http\Requests\Dashboard\Kendaraan\StoreKendaraanRequest;

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
                'message' => 'Data kendaraan berhasil ditambahkan.'
            ]);
    }

    /**
     * Menampilkan halaman tambah unit kendaraan
     *
     * @param Kendaraan $kendaraan
     * @return View
     */
    public function unit(Kendaraan $kendaraan): View
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
}
