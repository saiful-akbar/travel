<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman home dashboard
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.dashboard.home.index');
    }
}
