<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     *
     * @return View
     */
    public function login(): View
    {
        return view('pages.auth.login');
    }

    /**
     * Login user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        if (Auth::user()->role == 'member') {
            return redirect()->away($request->query('redirect'));
        }

        return to_route('dashboard.home');
    }

    /**
     * Logout
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('main.home');
    }

    /**
     * Menampilkan halaman register member
     *
     * @return View
     */
    public function register(): View
    {
        return view('pages.auth.register');
    }

    /**
     * Insert data member baru.
     *
     * @param RegisterRequest $request
     * @return Returntype
     */
    public function storeMember(RegisterRequest $request): RedirectResponse
    {
        /**
         * Ambil data member baru
         */
        $newMember = $request->insert();

        /**
         * Buat session login
         */
        Auth::login($newMember, true);

        /**
         * Redirect
         */
        return redirect()->away($request->query('redirect'));
    }
}
