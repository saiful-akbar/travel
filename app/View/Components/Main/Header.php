<?php

namespace App\View\Components\Main;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public array $menus = [
        [
            'name' => 'Tentang',
            'path' => 'about',
            'route' => 'main.about',
        ],
        [
            'name' => 'Layanan',
            'path' => 'layanan',
            'route' => 'main.layanan',
        ],
    ];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.header');
    }
}
