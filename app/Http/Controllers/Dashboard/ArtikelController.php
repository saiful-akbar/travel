<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\Artikel\ArtikelRequest;
use App\Http\Requests\Dashboard\Artikel\StoreArtikelRequest;
use App\Http\Requests\Dashboard\Artikel\UpdateArtikelRequest;

class ArtikelController extends Controller
{
    /**
     * Menampilkan halaman index artikel
     *
     * @param ArtikelRequest $request
     * @return View|JsonResponse
     */
    public function index(ArtikelRequest $request): View|JsonResponse
    {
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.artikel.index');
    }

    /**
     * Menampilkan halaman tambah artikel
     *
     * @return View
     */
    public function create(): View
    {
        $kategori = Kategori::select('id', 'nama')
            ->orderBy('nama', 'asc')
            ->get();

        return view('pages.dashboard.artikel.create', compact('kategori'));
    }

    /**
     * Insert data artikel baru ke database
     *
     * @param StoreArtikelRequest $request
     * @return RedirectResponse
     */
    public function store(StoreArtikelRequest $request): RedirectResponse
    {
        $request->insert();

        return to_route('dashboard.artikel.create')->with('alert', [
            'variant' => 'success',
            'message' => 'Artikel berhasil dibuat.'
        ]);
    }

    /**
     * Menampilkan halmaan edit artikel
     *
     * @param Artikel $artikel
     * @return View
     */
    public function edit(Artikel $artikel): View
    {
        $kategori = Kategori::select('id', 'nama')
            ->orderBy('nama', 'asc')
            ->get();

        return view('pages.dashboard.artikel.edit', compact('artikel', 'kategori'));
    }

    /**
     * Perbarui data artikel di database.
     *
     * @param UpdateArtikelRequest $request
     * @param Artikel $artikel
     * @return RedirectResponse
     */
    public function update(UpdateArtikelRequest $request, Artikel $artikel): RedirectResponse
    {
        $request->update();

        return to_route('dashboard.artikel')->with('alert', [
            'variant' => 'success',
            'message' => 'Artikel berhasil diperbarui.'
        ]);
    }

    /**
     * Hapus data artikel dari database.
     *
     * @param Artikel $artikel
     * @return RedirectResponse
     */
    public function destroy(Artikel $artikel): RedirectResponse
    {
        // Jika artikel memiliki gambar
        // hapus gambarnya dari storage
        if (!is_null($artikel->gambar)) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        // hapus artikel dari database
        $artikel->delete();

        return to_route('dashboard.artikel')->with('alert', [
            'variant' => 'success',
            'message' => 'Artikel berhasil dihapus.'
        ]);
    }
}
