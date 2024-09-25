<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Jadwal\JadwalRequest;

class JadwalController extends Controller
{
    /**
     * Menampilkan halaman jadwal.
     *
     * @param JadwalRequest $request
     * @return View|JsonResponse
     */
    public function index(JadwalRequest $request): View|JsonResponse
    {
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.jadwal.index');
    }
}
