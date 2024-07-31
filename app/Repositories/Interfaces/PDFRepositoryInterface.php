<?php

namespace App\Repositories\Interfaces;

 
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Type\NullType;

interface PDFRepositoryInterface
{
    public function generateInvoicePDF($invoice_no);

    public function generateReceiptPDF($pay_id);


}