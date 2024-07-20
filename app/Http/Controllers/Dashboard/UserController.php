<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Menampilkan halaman utama user
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.dashboard.user.index');
    }

    public function dataTable(): JsonResponse
    {
        return DataTables::of(User::query())
            ->addColumn('intro', 'Hello')
            ->toJson();
    }
}
