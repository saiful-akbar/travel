<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\Paket\DeletePaketRequest;
use App\Models\Paket;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Paket\PaketRequest;
use App\Http\Requests\Dashboard\Paket\StorePaketRequest;
use App\Http\Requests\Dashboard\Paket\UpdatePaketRequest;

class PaketController extends Controller
{
    /**
     * Menmpilkan halaman daftar paket.
     *
     * @return View|JsonResponse
     */
    public function index(PaketRequest $request): View|JsonResponse
    {
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.paket.index');
    }

    /**
     * Menmpilkan halaman tambah data paket.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.dashboard.paket.create');
    }

    /**
     * Tambahkan data paket ke database.
     *
     * @param StorePaketRequest $request
     * @return RedirectResponse
     */
    public function store(StorePaketRequest $request): RedirectResponse
    {
        $request->insert();

        return to_route('dashboard.paket.create')->with('alert', [
            'variant' => 'success',
            'message' => 'Paket berhasil ditambahkan.'
        ]);
    }

    /**
     * Menampilkan halaman edit paket.
     *
     * @param Paket $paket
     * @return View
     */
    public function edit(Paket $paket): View
    {
        return view('pages.dashboard.paket.edit', compact('paket'));
    }

    /**
     * Ubah paket ke database.
     *
     * @param UpdatePaketRequest $request
     * @param Paket $paket
     * @return RedirectResponse
     */
    public function update(UpdatePaketRequest $request, Paket $paket): RedirectResponse
    {
        $request->update();

        return to_route('dashboard.paket')->with('alert', [
            'variant' => 'success',
            'message' => 'Paket berhasill diperbarui.'
        ]);
    }

    /**
     * Hapus paket dari database
     *
     * @param DeletePaketRequest $request
     * @param Paket $paket
     * @return RedirectResponse
     */
    public function destroy(DeletePaketRequest $request, Paket $paket): RedirectResponse
    {
        try {
            $request->destroy();
        } catch (\Throwable $e) {

            /**
             * Kirimkan pesan jika terjadi kesalahan saat hapus paket
             */
            return back()->with('alert', [
                'variant' => 'warning',
                'message' => $e->getMessage(),
            ]);
        }

        return to_route('dashboard.paket')->with('alert', [
            'variant' => 'success',
            'message' => 'Paket berhasil dihapus.',
        ]);
    }
}
