<?php

namespace App\View\Components\Layouts\Dashboard\Horizontal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FullWidthNoHeader extends Component
{

    public $website_name;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->website_name = config('app.name');
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.dashboard.horizontal.full-width-no-header');
    }
}
