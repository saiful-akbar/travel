<?php

namespace App\Http\Controllers;

use App\Http\Requests\Main\Profil\UpdatePasswordMemberRequest;
use App\Http\Requests\Main\Profil\UpdateProfilMemberRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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

    /**
     * Update profil member
     *
     * @param UpdateProfilMemberRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateProfilMemberRequest $request): RedirectResponse {
        $request->update();

        return to_route('main.profil')->with('alert', [
            'variant' => 'success',
            'message' => 'Profil anda berhasil diperbarui.'
        ]);
    }

    /**
     * Update password member.
     *
     * @param UpdatePasswordMemberRequest $request
     * @return RedirectResponse
     */
    public function updatePassword(UpdatePasswordMemberRequest $request) : RedirectResponse {
        $request->update();

        return to_route('main.profil')->with('alert', [
            'variant' => 'success',
            'message' => 'Password anda berhasil diperbarui.'
        ]);
    }
}
