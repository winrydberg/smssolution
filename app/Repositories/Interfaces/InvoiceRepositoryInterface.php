<?php

namespace App\Repositories\Interfaces;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Type\NullType;

interface InvoiceRepositoryInterface
{
    public function findInvoice($invoice_no) : Invoice | null;

    public function calcInvoiceAmt($invoice_no) : float;

}