<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\DeleteUserRequest;
use App\Http\Requests\Dashboard\User\UserRequest;
use App\Http\Requests\Dashboard\User\StoreUserRequest;
use App\Http\Requests\Dashboard\User\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Menampilkan halaman utama user
     *
     * @return View
     */
    public function index(UserRequest $request): View|JsonResponse
    {
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.user.index');
    }

    /**
     * Menampilkan form halaman tambah user
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.dashboard.user.create');
    }

    /**
     * Tambahkan data user baru ke database.
     *
     * @param StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        /**
         * Jalankan proses insert data user.
         */
        $request->insert();

        return to_route('dashboard.user.create')->with('alert', [
            'variant' => 'success',
            'message' => 'User baru berhasil ditambahkan.'
        ]);
    }

    /**
     * Menampilkan halaman edit user
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('pages.dashboard.user.edit', compact('user'));
    }

    /**
     * Update data user.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $request->update();

        return to_route('dashboard.user')->with('alert', [
            'variant' => 'success',
            'message' => '1 User berhasil diperbarui.'
        ]);
    }

    /**
     * Hapus user dari database.
     *
     * @param DeleteUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(DeleteUserRequest $request, User $user): RedirectResponse
    {
        try {
            $request->destroy();
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', [
                'variant' => 'danger',
                'message' => 'Terjadi kesalahan. Gagal menghapus user.'
            ]);
        }

        return to_route('dashboard.user')->with('alert', [
            'variant' => 'success',
            'message' => '1 User berhasil dihapus.'
        ]);
    }
}
