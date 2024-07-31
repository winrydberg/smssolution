<?php

namespace App\Repositories;

use App\Models\Fee;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PendingPayment;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\Term;
use App\Models\User;
use App\Repositories\Interfaces\AcademicYearRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\Interfaces\TermRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentRepository implements PaymentRepositoryInterface
{
    protected $model;
    protected $termRepo;
    protected AcademicYearRepositoryInterface $academicYearRepository;
    protected StudentRepositoryInterface $studentRepository;

    /**
     * 
     * 
     */
    public function __construct(Payment $model, TermRepositoryInterface $termRepo, AcademicYearRepositoryInterface $academicYearRepository, StudentRepositoryInterface $studentRepository)
    {
        $this->model = $model;
        $this->termRepo = $termRepo;
        $this->academicYearRepository = $academicYearRepository;
        $this->studentRepository = $studentRepository;
    }

    /**
     * 
     * 
     */
    public function all() : Collection
    {
        return Payment::orderBy("id", "DESC")->get();
    }

    /**
     * 
     * 
     */
    public function getLatest($total=10) : Collection
    {
        $term = $this->termRepo->getActiveTerm();
        $academic_year = $this->academicYearRepository->getActiveAcademicYear();
        if(!is_null($term)){
            return Payment::where("term_id", $term->id)->where("academic_year_id", $academic_year?->id)->orderBy("id", "DESC")->with("student", "student.guardian")->take($total)->get();
        }else{
            return [];
            // return Payment::orderBy("id", "DESC")->with("student", "student.guardian")->take($total)->get();
        }
       
    }

    /**
     * 
     * 
     */
    public function find($id) : Payment
    {
        return $this->model->find($id);
    }

    /**
     * 
     * 
     */
    public function create(array $data) : Payment | null
    {
        return $this->model->create($data);
    }

    /**
     * 
     * 
     */
    public function update($id, array $data) : bool
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    /**
     * 
     * 
     */
    public function delete($id) : bool
    {
        $user = $this->model->find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }

    /**
     * 
     * 
     */
    public function savePaymentInfo(Request $request) : array
    {
       return [

       ];
    }


    /**
     * 
     * 
     * 
     */
    public function calculateThisTermFees() : float
    {
        $term = Term::where("active", true)->first();
        $academic_year = $this->academicYearRepository->getActiveAcademicYear();
        return Payment::where("term_id", $term->id)->where("academic_year_id", $academic_year?->id)->sum("amount");
    }


    /**
     * 
     * 
     */
    public function searchPayments(Request $request) : Collection
    {
        $admission_no = $request->query("admissionno", null);
        $receipt_no = $request->query("receiptno", null);
        $class_id = $request->query("class", null);
        return Payment::when(!empty($admission_no), function($query) use($admission_no){
                            $student = Student::where("admission_no", $admission_no)->first();
                            $query->where('admission_no', 'like', '%' . $admission_no ."%")->orWhere('student_id', $student?->id);
                        })
                        ->when(!empty($receipt_no), function($query) use($receipt_no){
                            $query->where('receipt_no', $receipt_no);
                        })
                        ->when(!empty($class_id), function($query) use($class_id){
                            $query->where('class_id', $class_id)->where("academic_year", env('ACADEMIC_YEAR'));
                        })
                        ->get();
    }


    /**
     * 
     * 
     * 
     */
    public function generateInvoice($student_id, $gtype, $fees): array
    {
        switch($gtype){
            case "ALL_FEES":
                $fees = $this->studentRepository->getStudentPendingFees($student_id);
                $invoice_no = $this->genereateInvoiceNo($student_id);
                foreach($fees as $fee){
                    $invoice = Invoice::where("fee_id", $fee->id)->where("student_id", $student_id)->where("status", "UNPAID")->first();
                    if(is_null($invoice)){
                        Invoice::create([
                            "invoice_no" => $invoice_no,
                            "student_id" => $student_id,
                            "fee_id" => $fee->id,
                            "status" => "UNPAID"
                        ]);
                    }else{
                        $invoice->update([
                            "invoice_no" => $invoice_no,
                        ]);
                    }
                }
                return [
                    "status" => "success",
                    "invoice_no" => $invoice_no,
                    "message" => "Invoice successfully created"
                ];
                break;
            case "SELECTED":
                $fees = Fee::whereIn("id", $fees)->get();
                $invoice_no = $this->genereateInvoiceNo($student_id);
                foreach($fees as $fee){
                    $invoice = Invoice::where("fee_id", $fee->id)->where("student_id", $student_id)->where("status", "UNPAID")->first();
                    if(is_null($invoice)){
                        Invoice::create([
                            "invoice_no" => $invoice_no,
                            "student_id" => $student_id,
                            "fee_id" => $fee->id,
                            "status" => "UNPAID"
                        ]);
                    }else{
                        $invoice->update([
                            "invoice_no" => $invoice_no,
                        ]);
                    }
                }
                return [
                    "status" => "success",
                    "invoice_no" => $invoice_no,
                    "message" => "Invoice successfully created"
                ];
                break;
            default:
                return [
                    "status" => "error",
                    "message" => "Unable to create invoice. Please try again"
                ];
        }
    }


    
    /**
     * 
     * 
     * 
     */
    public function genereateInvoiceNo($student_id){
        return mt_rand(100, 999).date('d').date('m').date('y').$student_id;
    }
}