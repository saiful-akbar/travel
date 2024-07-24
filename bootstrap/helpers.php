<?php

use App\Models\User;

if (!function_exists('dashboard_asset')) {

    /**
     * helper dashboard assets
     *
     * @param string $path
     * @param boolean|null $secure
     * @return string
     */
    function dashboard_asset(string $path, ?bool $secure = null): string
    {
        return asset('assets/dashboard/' . ltrim($path, '/'), $secure);
    }
}

if (!function_exists('main_asset')) {

    /**
     * helper main assets
     *
     * @param string $path
     * @param boolean|null $secure
     * @return string
     */
    function main_asset(string $path, ?bool $secure = null): string
    {
        return asset('assets/main/' . ltrim($path, '/'), $secure);
    }
}

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
        if (!is_null($path)) {
            return storage($path);
        }

        return dashboard_asset('images/photo_empty.jpg');
    }
}
