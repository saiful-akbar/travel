<?php

use App\Models\MediaSosial;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

if (!function_exists('storage')) {

    /**
     * helper storage assets
     *
     * @param string $path
     * @param boolean|null $secure
     * @return string
     */
    function storage(string $path = '/', ?bool $secure = null): string
    {
        return asset('storage/' . ltrim($path, '/'), $secure);
    }
}

if (!function_exists('user')) {

    /**
     * Helper auth user.
     *
     * @return User|null
     */
    function user(): ?User
    {
        return auth()->user();
    }
}

if (!function_exists('perusahaan')) {

    /**
     * Helper untuk mengambil data perusahaan.
     *
     * @return Perusahaan|null
     */
    function perusahaan(): ?Perusahaan
    {
        static $perusahaan = null;

        if (is_null($perusahaan)) {
            $perusahaan = Perusahaan::first();
        }

        return $perusahaan;
    }
}

if (!function_exists('media_sosial')) {

    /**
     * Helper untuk mengambil data media sosdial.
     *
     * @return Collection|null
     */
    function media_sosial(): ?Collection
    {
        static $mediaSosial = null;

        if (is_null($mediaSosial)) {
            $mediaSosial = MediaSosial::all();
        }

        return $mediaSosial;
    }
}

if (!function_exists('photo')) {

    /**
     * Helper user avatar.
     *
     * @return string
     */
    function photo(?string $path = null): string
    {
        if (is_null($path)) {
            return asset('assets/images/photo_empty.jpg');
        }

        return storage($path);
    }
}

if (!function_exists('image')) {

    /**
     * Helper untukk pratinjau gambar.
     *
     * @param string|null $path
     * @return string
     */
    function image(string $path = null): string
    {
        if (is_null($path)) {
            return asset('assets/images/image_empty.jpg');
        }

        return storage($path);
    }
}

if (!function_exists('dashboard_asset')) {

    /**
     * Helper dashboard asset
     *
     * @param string $path
     * @param boolean|null $secure
     * @return string
     */
    function dashboard_asset(string $path = '/', ?bool $secure = null): string
    {
        return asset('assets/dashboard/' . ltrim($path, '/'), $secure);
    }
}

if (!function_exists('main_asset')) {

    /**
     * Helper dashboard asset
     *
     * @param string $path
     * @param boolean|null $secure
     * @return string
     */
    function main_asset(string $path = '/', ?bool $secure = null): string
    {
        return asset('assets/main/' . ltrim($path, '/'), $secure);
    }
}

if (!function_exists('main_menu')) {

    /**
     * Helper untuk menagmbil data main menu
     *
     * @return array
     */
    function main_menu(): array
    {
        return [
            [
                'name' => 'Home',
                'path' => '/',
                'route' => 'main.home',
            ],
            [
                'name' => 'Tentang Kami',
                'path' => '/tentang-kami',
                'route' => 'main.tentangKami',
            ],
            [
                'name' => 'Layanan',
                'path' => '/layanan',
                'route' => 'main.layanan',
            ],
            [
                'name' => 'Pemesanan',
                'path' => '/pemesanan',
                'route' => 'main.pemesanan',
            ],
        ];
    }
}
