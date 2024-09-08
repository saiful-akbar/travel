<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Pesanan\PesananRequest;

class PesananController extends Controller
{
    /**
     * Menampilkan halaman daftar pesanan pada dashboard.
     *
     * @param PesananRequest $request
     * @return View|JsonResponse
     */
    public function index(PesananRequest $request): View|JsonResponse
    {
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.pesanan.index');
    }
}
