<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Fee;
use App\Models\Guardian;
use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\PDFRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PDFRepository implements PDFRepositoryInterface
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }


    public function generateInvoicePDF($invoice_no)
    {
        
    }

    public function generateReceiptPDF($pay_id)
    {
        $payment = $this->paymentRepository->find($pay_id);
        if(!is_null($payment)){
            $student = Student::where("id", $payment->student_id)->first();
            $fee = Fee::where("id", $payment->fee_id)->first();
            $guardian = Guardian::where("id", $student?->guardian_id)->first();
            $data = [
                "payment" => $payment,
                "student" => $student,
                "fee" => $fee,
                "guardian" => $guardian
            ];
            $customPaper = array(0,0,600.00,667.80);
            $pdf = Pdf::loadView('app.pdf.receipt', $data)->setPaper($customPaper, 'landscape');
            return $pdf->stream();
        }else{
            $pdf = Pdf::loadView('app.pdf.no_receipt');
            return $pdf->stream();
        }
    }

}