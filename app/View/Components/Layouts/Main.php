<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Main extends Component
{
    public string $title;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title = null)
    {
        if (is_null($title)) {
            $this->title = config('app.name');
        } else {
            $this->title = $title . ' - ' . config('app.name');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.main.index');
    }
}
