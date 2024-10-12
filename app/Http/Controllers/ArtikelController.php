<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Menampilkan halaman artikel
     *
     * @return View
     */
    public function index(): View
    {
        $columns = [
            'id',
            'kategori_id',
            'judul',
            'gambar',
            'created_at',
        ];

        $artikels = Artikel::select($columns)
            ->where('publikasikan', true)
            ->paginate(24);

        return view('pages.main.artikel.index', compact('artikels'));
    }

    /**
     * Menampilkan detail post artikel
     *
     * @param Artikel $artikel
     * @return View
     */
    public function show(Artikel $artikel): View
    {
        if (!$artikel->publikasikan) {
            abort(404);
        }

        return view('pages.main.artikel.show', [
            'artikel' => $artikel->load('kategori'),
        ]);
    }
}
