<?php

namespace App\View\Components;

use App\Models\Term;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardComponent extends Component
{
    public $student_count = 0;
    public $staff_count = 0;
    public $classes_count = 0;
    public $total_fees = 0.0;
    public $term = null;
    /**
     * Create a new component instance.
     */
    public function __construct($studentcount, $staffcount , $classescount, $totalfees, $term)
    {
        $this->student_count = $studentcount;
        $this->staff_count = $staffcount;
        $this->classes_count = $classescount;
        $this->total_fees = $totalfees;
        $this->term = $term==null ? Term::where("active", true)->first(): $term;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-component');
    }
}
