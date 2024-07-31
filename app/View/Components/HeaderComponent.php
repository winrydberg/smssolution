<?php

namespace App\View\Components;

use App\Models\Term;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderComponent extends Component
{
    public $term;
    public $academic_year;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->term = Term::where('active', true)->first();
        $this->academic_year = env("ACADEMIC_YEAR");
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header-component');
    }
}
