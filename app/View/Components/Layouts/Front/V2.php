<?php

namespace App\View\Components\Layouts\Front;

use App\Models\Navigation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class V2 extends Component
{

    public $headerNavigations, $footerNavigations;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->headerNavigations = Navigation::active()->available()->header()->sequenceOrder()->get();
        $this->footerNavigations = Navigation::active()->available()->footer()->sequenceOrder()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.front.v2');
    }
}
