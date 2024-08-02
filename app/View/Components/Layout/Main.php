<?php

namespace App\View\Components\Layout;

use App\Models\MediaSosial;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Main extends Component
{
    public string $title;
    public string $headerBgColor = 'light';
    public string $footerBgColor = 'light';
    public string $bgColor = 'bg-white';

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $title,
        string $headerBgColor = 'light',
        string $footerBgColor = 'white',
        string $bgColor = 'white',
    ) {
        $this->title = $title;

        /**
         * Header color
         */
        if ($headerBgColor == 'dark') {
            $this->headerBgColor = 'dark';
        }

        /**
         * Footer color
         */
        $this->footerBgColor = $footerBgColor;

        /**
         * Body background color
         */
        switch ($bgColor) {
            case 'light':
                $this->bgColor = 'bg-light';
                break;

            default:
                $this->bgColor = 'bg-white';
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.main');
    }
}
