<?php

namespace App\View\Components;

use App\Repositories\Interfaces\ReportsRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GenderStatisticsComponent extends Component
{
    public $chart_data;
    /**
     * Create a new component instance.
     */
    public function __construct(ReportsRepositoryInterface $reportsRepository)
    {
        $this->chart_data = $reportsRepository->generateGenderChart();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gender-statistics-component');
    }
}
