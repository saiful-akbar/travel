<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Supir;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Supir\DeleteSupirRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Supir\SupirRequest;
use App\Http\Requests\Dashboard\Supir\StoreSupirRequest;
use App\Http\Requests\Dashboard\UpdateSupirRequest;

class SupirController extends Controller
{
    /**
     * Menampilkan halaman utama supir.
     *
     * @return View|JsonResponse
     */
    public function index(SupirRequest $request): View|JsonResponse
    {
        /**
         * Jika request berupa ajax.
         * Kemablikan response datatable.
         */
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.supir.index');
    }

    /**
     * Menampilkan halaman form tambah data user.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.dashboard.supir.create');
    }

    /**
     * Menambahkan data supir ke database.
     *
     * @param StoreSupirRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSupirRequest $request): RedirectResponse
    {
        $request->insert();

        return to_route('dashboard.supir.create')->with('alert', [
            'variant' => 'success',
            'message' => 'Data supir berhasil ditambahkan.'
        ]);
    }

    /**
     * Menampilkan halaman edit supir.
     *
     * @param Supir $supir
     * @return View
     */
    public function edit(Supir $supir): View
    {
        return view('pages.dashboard.supir.edit', compact('supir'));
    }

    /**
     * Update data supir
     *
     * @param UpdateSupirRequest $request
     * @param Supir $supir
     * @return RedirectResponse
     */
    public function update(UpdateSupirRequest $request, Supir $supir): RedirectResponse
    {
        $request->update();

        return to_route('dashboard.supir')->with('alert', [
            'variant' => 'success',
            'message' => '1 Data supir berhasil diperbarui.'
        ]);
    }

    /**
     * Hapus data supir
     *
     * @param DeleteSupirRequest $request
     * @return RedirectResponse
     */
    public function destroy(DeleteSupirRequest $request, Supir $supir): RedirectResponse
    {
        try {
            $request->destroy();
        } catch (\Throwable $e) {

            /**
             * Kirimkan pesan bahwa supir ini masih memiliki pesanan.
             */
            return back()->with('alert', [
                'variant' => 'warning',
                'message' => $e->getMessage(),
            ]);
        }

        return to_route('dashboard.supir')->with('alert', [
            'variant' => 'success',
            'message' => 'Supir berhasil dihapus.'
        ]);
    }
}
