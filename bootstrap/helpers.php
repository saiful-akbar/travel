<?php

use App\Models\Perusahaan;
use App\Models\User;

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

if (!function_exists('avatar')) {

    /**
     * Helper user avatar.
     *
     * @return string
     */
    function avatar(?string $path = null): string
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

if (!function_exists('perusahaan')) {

    /**
     * Helper untuk mengambil data perusahaan.
     *
     * @return Perusahaan|null
     */
    function perusahaan(): ?Perusahaan
    {
        return Perusahaan::first();
    }
}
