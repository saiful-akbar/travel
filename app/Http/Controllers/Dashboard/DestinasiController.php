<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Destinasi\DestinasiRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
}
