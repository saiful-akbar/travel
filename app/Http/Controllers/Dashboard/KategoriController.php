<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Kategori\DeleteKategoriRequest;
use App\Http\Requests\Dashboard\Kategori\KategoriRequest;
use App\Http\Requests\Dashboard\Kategori\StoreKategoriRequest;
use App\Http\Requests\Dashboard\Kategori\UpdateKategoriRequest;
use Illuminate\Http\RedirectResponse;

class KategoriController extends Controller
{
    /**
     * Menampilkan halaman utaman kategori
     *
     * @param KategoriRequest $request
     * @return View|JsonResponse
     */
    public function index(KategoriRequest $request): View|JsonResponse
    {
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.kategori.index');
    }

    /**
     * Insert kategori artikel baru.
     *
     * @param StoreKategoriRequest $request
     * @return JsonResponse
     */
    public function store(StoreKategoriRequest $request): JsonResponse
    {
        // Jika request bukan ajax tampilkan error 404
        if (!$request->ajax()) {
            abort(404);
        }

        // Jalankan proses insert
        $request->insert();

        return response()->json([
            'message' => 'Kategori artikel berhasil ditambahkan.'
        ]);
    }

    /**
     * Mengambil data kategori untuk diedit.
     *
     * @param Kategori $kategori
     * @return JsonResponse
     */
    public function edit(Request $request, Kategori $kategori): JsonResponse
    {
        // Jika request bukan ajax tampilkan error 404
        if (!$request->ajax()) {
            abort(404);
        }

        return response()->json([
            'data' => $kategori
        ]);
    }

    /**
     * Perbarui data kategori
     *
     * @param UpdateKategoriRequest $request
     * @param Kategori $kategori
     * @return JsonResponse
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori): JsonResponse
    {
        // jika request bukan ajax tampilkan 404
        if (!$request->ajax()) {
            abort(404);
        }

        // Jalankan proses update
        $request->update();

        return response()->json([
            'message' => 'Kategori berhasil diperbarui.'
        ]);
    }

    /**
     * Menghapus data kategori
     *
     * @param DeleteKategoriRequest $request
     * @param Kategori $kategori
     * @return JsonResponse
     */
    public function destroy(DeleteKategoriRequest $request, Kategori $kategori): RedirectResponse
    {
        // Jalankan proses delete
        try {
            $request->destroy();
        } catch (\Throwable $e) {
            return back()->with('alert', [
                'variant' => 'danger',
                'message' => $e->getMessage(),
            ]);
        }
        return to_route('dashboard.kategori')->with('alert', [
            'variant' => 'success',
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }
}
