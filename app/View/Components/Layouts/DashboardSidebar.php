<?php

namespace App\View\Components\Layouts;

use App\Models\Perusahaan;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardSidebar extends Component
{
    public ?Perusahaan $perusahaan = null;

    /**
     * Class css sidebar
     *
     * @var array
     */
    public array $classes = [
        'js-navbar-vertical-aside',
        'navbar',
        'navbar-expand-lg',
        'navbar-vertical-aside',
        'navbar-vertical',
        'navbar-vertical-fixed',
        'navbar-bordered',
        'splitted-content-navbar',
        'bg-white',
    ];

    /**
     * Daftar menu
     *
     * @var array
     */
    public array $menus = [
        [
            'name' => 'Data Master',
            'sub_menu' => [
                [
                    'name' => 'User',
                    'path' => 'dashboard/user',
                    'route' => 'dashboard.user',
                    'icon' => 'bi-people',
                ],
                [
                    'name' => 'Supir',
                    'path' => 'dashboard/supir',
                    'route' => 'dashboard.supir',
                    'icon' => 'bi-person',
                ],
                [
                    'name' => 'Kendaraan',
                    'path' => 'dashboard/kendaraan',
                    'route' => 'dashboard.kendaraan',
                    'icon' => 'bi-car-front',
                ],
                [
                    'name' => 'Perusahaan',
                    'path' => 'dashboard/perusahaan',
                    'route' => 'dashboard.perusahaan',
                    'icon' => 'bi-building',
                ],
            ],
        ],
        [
            'name' => 'Perjalanan',
            'sub_menu' => [
                [
                    'name' => 'Paket Perjalanan',
                    'path' => 'dashboard/paket',
                    'route' => 'dashboard.paket',
                    'icon' => 'bi-box2',
                ],
                [
                    'name' => 'Destinasi',
                    'path' => 'dashboard/destinasi',
                    'route' => 'dashboard.destinasi',
                    'icon' => 'bi-map',
                ],
                [
                    'name' => 'Harga',
                    'path' => 'dashboard/harga',
                    'route' => 'dashboard.harga',
                    'icon' => 'bi-cash',
                ],
            ],
        ],
        [
            'name' => 'Transaksi',
            'sub_menu' => [
                [
                    'name' => 'Pesanan',
                    'path' => 'dashboard/pesanan',
                    'route' => 'dashboard.pesanan',
                    'icon' => 'bi-bag-check',
                ],
                [
                    'name' => 'Jadwal',
                    'path' => 'dashboard/jadwal',
                    'route' => 'dashboard.jadwal',
                    'icon' => 'bi-clock',
                ],
            ],
        ],
    ];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->perusahaan = Perusahaan::select('nama', 'logo')->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.dashboard-sidebar.index');
    }
}
