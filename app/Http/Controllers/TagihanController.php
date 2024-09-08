<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Main\Tagihan\TagihanRequest;

class TagihanController extends Controller
{
    /**
     * Menampilkan halaman daftar tagihan dari pesanan member.
     *
     * @param TagihanRequest $request
     * @return View
     */
    public function index(TagihanRequest $request): View
    {
        return view('pages.main.tagihan.index', [
            'tagihan' => $request->getData(),
        ]);
    }

    /**
     * Mengambil data detail tagihan dan pesanan.
     *
     * @param Tagihan $tagihan
     * @return JsonResponse
     */
    public function show(Tagihan $tagihan): JsonResponse
    {
        return response()->json([
            'data' => $tagihan->load('pesanan'),
        ]);
    }
}
