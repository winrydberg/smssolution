<?php

namespace App\Listeners;

use App\Events\GenerateInvoiceEvent;
use App\Models\Fee;
use App\Models\PendingPayment;
use App\Models\Student;
use App\Models\StudentInvoice;
use App\Models\Term;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class GenerateInvoiceListener
{
    public $event;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        // $this->event = $event;
    }

    /**
     * Handle the event.
     */
    public function handle(GenerateInvoiceEvent $event): void
    {
        // $this->event = $event;
        // switch($event?->request?->applies_on){
        //     case "ALL":
        //         Student::orderBy("id", "ASC")->chunk(1000, function($students){
        //             $this->createPendingPaymentInvoice($students);
        //         });
        //     break;

        //     case "CLASS":
        //         $students = Student::whereIn("class_id", $event->request->classes)->whereIn("sub_class_id", $event->request->sub_class_id)->get();
        //         $this->createPendingPaymentInvoice($students);
        //         break;

        //     case "STUDENT":
        //         $students = Student::whereIn('id', $event->request->students)->get();
        //         $this->createPendingPaymentInvoice($students);
        //         break;
        //     default:
        //         Log::info("NOTHING TO DO ABOUT INVOICE GENERATION");
        //         break;
        // }
        
    }


    public function createPendingPaymentInvoice(Collection $students) : void
    {
        // $term = Term::where("active", true)->first();
        // foreach ($students as $student) {
        //     $fees = $this->event->request->fees;
        //     if(is_array($fees)){
        //         $inv_no = mt_rand(0, 99).$student->id.date("d").date("m").date("y");
        //         foreach($fees as $key => $fee_id){
        //             $fee = Fee::where("id", $fee_id)->first();

        //             $check_inv = StudentInvoice::where("student_id", $student->id)
        //                                         ->where("admission_no", $student->admission_no)
        //                                         ->where("fee_id", $fee_id)
        //                                         ->where("academic_year", env("ACADEMIC_YEAR"))
        //                                         ->first();
        //             // check if the student has already been billed for the current academic year and for the particular fee
        //             if(is_null($check_inv)){
        //                 PendingPayment::create([
        //                     "stud_pay_category" => "INV".$inv_no,
        //                     "invoice_no" => strtoupper(substr($fee->name, 0, 2)).$fee->id.$inv_no,
        //                     "student_id" => $student->id,
        //                     "admission_no" => $student->admission_no,
        //                     "fee_id" => $fee_id,
        //                     "amount" => $fee->amount,
        //                     "academic_year" => env("ACADEMIC_YEAR"),
        //                     "term_id" => $term->id,
        //                     "guardian_id" => $student->guardian_id,
        //                     "invoice_category" => $this->event?->invoice_category,
        //                     "invoice_category_id" => $this->event?->invoice_category_id
        //                 ]);
    
        //                 StudentInvoice::create([
        //                     "invoice_category" => $this->event?->invoice_category,
        //                     "invoice_category_id" => $this->event?->invoice_category_id,
        //                     "term_id" => $term->id,
        //                     "admission_no" => $student->admission_no,
        //                     "student_id" => $student->id,
        //                     "fee_id" => $fee_id,
        //                     "academic_year" => env("ACADEMIC_YEAR")
        //                 ]);
        //             }

                    
        //         }
        //     }
        // }
    }
}
