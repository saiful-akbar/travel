<?php

namespace App\View\Components\Main;

use App\Models\MediaSosial;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Footer extends Component
{
    public string $bgColor = 'bg-white';
    public string $textColor = 'text-black';

    /**
     * Create a new component instance.
     */
    public function __construct(string $bgColor = 'white')
    {
        if ($bgColor == 'dark') {
            $this->bgColor = 'bg-black inverted';
            $this->textColor = 'text-white';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.footer');
    }
}
