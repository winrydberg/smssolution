<?php

namespace App\View\Components;

use App\Models\Payment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaymentComponent extends Component
{
    public $payments = [];
    /**
     * Create a new component instance.
     */
    public function __construct($payments)
    {
        $this->payments = $payments;
        // $this->payments = Payment::orderBy("created_at", "DESC")->take(200)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.payment-component');
    }
}
