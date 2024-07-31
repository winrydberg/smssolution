<?php

namespace App\View\Components;

use App\Repositories\Interfaces\AcademicYearRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertComponent extends Component
{
    public $error = false;
    public $message = "";
    /**
     * Create a new component instance.
     */
    public function __construct(AcademicYearRepositoryInterface $acaRepo)
    {
        $academic_year = $acaRepo->getActiveAcademicYear();
        if(is_null($academic_year)){
            $this->error = true;
            $this->message = "Academic Year has not been setup. Visit [ Setup > Academic Year & Terms ] to set it up";
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-component');
    }
}
