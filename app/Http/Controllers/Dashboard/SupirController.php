<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Supir\SupirRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
}
