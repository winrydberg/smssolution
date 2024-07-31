<?php

namespace App\View\Components;

use App\Repositories\Interfaces\FeesRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\PaymentRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeeStatisticsComponent extends Component
{

    protected FeesRepositoryInterface $feeRepo;

    public $pending_fees = 0.0;

    public $fees_collected = 0.0;
    // public $ = 0.0;
    /**
     * Create a new component instance.
     */
    public function __construct(FeesRepositoryInterface $feeRepo)
    {
        $this->feeRepo = $feeRepo;

        $this->calculatePendingFees();
        $this->calculateFeesCollected();
    }

    public function calculatePendingFees(){
        $this->pending_fees = $this->feeRepo->getTotalPendingFees();
    }

    public function calculateFeesCollected(){
        $this->fees_collected = $this->feeRepo->getTotalFeesCollected();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fee-statistics-component');
    }
}
