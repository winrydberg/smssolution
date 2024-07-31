<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Repositories\Interfaces\FeesRepositoryInterface;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\PDFRepositoryInterface;
use App\Repositories\Interfaces\SClassRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public $paymentRepository;
    public $invoiceRepository;
    public $feeRepository;
    public $studentRespository;
    public $classRepository;
    public $pdfRepository;

    public function __construct(
        PaymentRepositoryInterface $paymentRepository, 
        FeesRepositoryInterface $feeRepository, 
        StudentRepositoryInterface $studentRespository,
        SClassRepositoryInterface $classRespository,
        PDFRepositoryInterface $pdfRepository,
        InvoiceRepositoryInterface $invoiceRepository
    )
    {
        $this->paymentRepository = $paymentRepository;
        $this->feeRepository = $feeRepository;
        $this->studentRespository = $studentRespository;
        $this->classRepository = $classRespository;
        $this->pdfRepository = $pdfRepository;
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * 
     * 
     */
    public function generateInvoice(Request $request){
        $student_id = $request->sid;
        $gtype = $request->gtype;
        $fees = $request->fees;

        $res = $this->paymentRepository->generateInvoice($student_id, $gtype, $fees);
       return response()->json($res);
    }

    /**
     * 
     * 
     */
    // public function saveInvoice(Request $request){
    //     try{
    //         $this->invoiceRepository->generatePaymentInvoices($request);
    //         return response()->json([
    //             "status" => "success",
    //             "message" => "Invoice successfully generated for selected fees"
    //         ]);
    //     }catch(Exception $e){
    //         Log::error($e);
    //         return response()->json([
    //             "status" => "error",
    //             "message" => "Unable to create invoice. Please try again"
    //         ]);
    //     }
    // }

    /**
     * 
     * 
     */
    public function unpaidInvoices(){
        // $invoices = $this->invoiceRepository->getUnpaidInvoices();
        return view("app.invoices.unpaid", compact("invoices"));
    }

    /**
     * 
     * 
     */
    // public function deleteInvoiceCategory(Request $request){
    //     $res = $this->invoiceRepository->deleteInvoiceCategory((int)$request->id);
    //     return response()->json($res);
    // }

    /**
     * 
     * 
     */
    public function findInvoice(Request $request){
        $invoice_check_res = $this->invoiceRepository->findInvoice($request->invoice);
        if($invoice_check_res != null){
            return response()->json([
                "status" => "success",
                "pay_url" => url("/accept-payment?invoiceno={$invoice_check_res->invoice_no}&sid={$invoice_check_res->student?->id}")
            ]);
        }else{
            return response()->json([
                "status" => "error",
                "message" => "Invoice not found. Please check and try again"
            ]);
        }
    }

    /**
     * 
     * 
     */
    public function acceptPayment(Request $request){
        $invoice = $request->query("invoiceno", null);
        $invoice_info = null;
        $invoice_amt = 0.0;
        if(!is_null($invoice)){
            $invoice_info = $this->invoiceRepository->findInvoice($invoice);
            $invoice_amt = $this->invoiceRepository->calcInvoiceAmt($invoice);
        }
        return view("app.invoices.accept_payments", compact("invoice_info", "invoice_amt"));
    }

    /**
     * 
     * 
     */
    public function savePayment(Request $request){
        $res = $this->paymentRepository->savePaymentInfo($request);
        return response()->json($res);
    }


    public function generatePaymentReceipt(Request $request){
        $pay_id = $request->query("payid", 0);
        if($pay_id == null || $pay_id == 0){
            return back();
        }
        return $this->pdfRepository->generateReceiptPDF($pay_id);
    }


    public function payments(Request $request){
        $searched = $request->query("search", null);
        if($searched != null){
            $payments = $this->paymentRepository->searchPayments($request);
        }else{
            $payments = $this->paymentRepository->all();
        }
        $classes = $this->classRepository->all();
        return view("app.invoices.payments", compact("payments", "classes"));
    }




}
