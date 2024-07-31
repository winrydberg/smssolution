<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Fee;
use App\Models\Guardian;
use App\Models\Invoice;
use App\Models\Payment;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function findInvoice($invoice_no): ?Invoice
    {
        return Invoice::where("invoice_no", $invoice_no)->with("student")->first();
    }

    public function calcInvoiceAmt()
    {
        
    }

}