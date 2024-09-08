<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Menampilkan halaman profil member
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.main.profil.index');
    }
}
