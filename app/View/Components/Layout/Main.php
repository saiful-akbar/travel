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
    public string $headerBgColor;
    public string $footerBgColor;
    public string $bgColor;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $title,
        string $headerBgColor = 'white',
        string $footerBgColor = 'white',
        string $bgColor = 'white',
    ) {
        $this->title = $title;

        /**
         * Header color
         */
        switch ($headerBgColor) {
            case 'dark':
                $this->headerBgColor = 'dark';
                break;

            case 'light':
                $this->headerBgColor = 'light';
                break;

            default:
                $this->headerBgColor = 'white';
                break;
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
