<?php

namespace App\Repositories;

use App\Models\Fee;
use App\Models\Guardian;
use App\Models\Payment;
use App\Models\PendingPayment;
use App\Models\Student;
use App\Models\StudentPayment;
use App\Models\Term;
use App\Models\User;
use App\Repositories\Interfaces\AcademicYearRepositoryInterface;
use App\Repositories\Interfaces\FeesRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentRepository implements StudentRepositoryInterface
{
    protected $model;
    protected FeesRepositoryInterface $feesRepository;
    protected AcademicYearRepositoryInterface $acaRepo;

    public function __construct(Student $model, FeesRepositoryInterface $feesRepository, AcademicYearRepositoryInterface $acaRepo)
    {
        $this->model = $model;
        $this->feesRepository = $feesRepository;
        $this->acaRepo = $acaRepo;
    }

    /**
     * 
     * 
     */
    public function getStudents() : Collection
    {
        return Student::all();
    }

    /**
     * 
     * 
     */
    public function all() : Collection
    {
        return Student::with("guardian", "sclass", "sub_class")->get();
    }

    /**
     * 
     * 
     */
    public function find($id) : Model
    {
        return Student::where("id", $id)->with("guardian", 
                                                "sclass", 
                                                "sub_class", 
                                                "payments", 
                                                "payments.term", 
                                                "payments.fee"
                                        )->first();
    }

    /**
     * 
     * 
     */
    public function create(array $data) : Model | null
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
     * @param array $data
     */
    public function searchStudents($admission_no, $student_name, $class): Collection
    {
        return Student::when(!empty($admission_no), function($query) use($admission_no){
                    $query->where('admission_no', 'like', '%' . $admission_no ."%");
                })
                ->when(!empty($class), function($query) use($class){
                    $query->where('class_id', $class);
                })
                ->when(!empty($student_name), function($query) use($student_name){
                    $query->where('first_name', 'like', '%' . $student_name ."%")->orWhere("last_name", "like", "%".$student_name."%");
                })
                ->get();
    }

    /**
     * 
     * 
     */
    public function generateAdmissionNo() : string
    {
        $student = Student::orderBy("id", "DESC")->first();
        $student_id = $student != null ? $student->id : 0;
        return env("ADMISSION_NO_PREFIX").'/'.($student_id+1).'/'. substr(date("Y"), -2);
    }

    /**
     * 
     * 
     */
    public function calculatePendingFees($sid) : float
    {
        return $this->feesRepository->getStudentTotalPendingFees($sid);

    }

    /**
     * 
     * 
     */
    public function getActiveStudents() : Collection
    {
        return Student::where("active", true)->get();
    }

    /**
     * 
     * 
     */
    public function getStudentPendingFees($sid) : Collection
    {
        // $academic_year = $this->acaRepo->getActiveAcademicYear();
        $fees_paid = StudentPayment::where("student_id", $sid)->pluck("fee_id")->toArray();
        
        $fees =  Fee::whereNotIn("id", $fees_paid)->get();
        
        //filter the fees
        $the_fees = [];
        foreach($fees as $fee){
            switch($fee->applies_on){
                case "ALL":
                    $the_fees[] = $fee->id;
                    continue;
                case "CLASS":
                    if(is_array(json_decode($fee->model)) && in_array($sid, json_decode($fee->model))){
                        $the_fees[] = $fee->id;
                    }
                    break;
                default:
                    $the_fees[] = $fee->id;
                    break;
            }
           
        }

        return Fee::whereIn("id", $the_fees)->with("academic_year")->get();
    }

    /**
     * 
     * 
     */
    public function createStudent(Request $request) : array
    {
        $student = null;
        try{
            $academic_year = $this->acaRepo->getActiveAcademicYear();
            if(is_null($academic_year)){
                return [
                    "status" => false,
                    "message" => "Academic year has not been setup. Please setup academic year to proceed and add students"
                ];
            }
            $student = Student::create([
                "admission_no" => $request->admission_no,
                "first_name" => $request->first_name,
                "middle_name" => $request->middle_name,
                "last_name" => $request->last_name,
                "photo" => $request->image_src,
                "class_id" => $request->class,
                "sub_class_id" => $request->subclass,
                "gender" => $request->gender,
                "active" => true,
                "student_status_id" => 1
            ]);

        
            if($request->guardian == "NEW"){
                $guardian = Guardian::create([
                    "first_name" => $request->guardian_firstname,
                    "last_name" => $request->guardian_lastname,
                    "email" => $request->guardian_email,
                    "phone" => $request->guardian_phone,
                    "house_no" => $request->guardian_houseno,
                    "occupation" => $request->guardian_occupation,
                ]);
            }else{
                $guardian = Guardian::where("id", $request->guardian)->first();
            }

            $term = Term::where("active", true)->first();
            $invoice_no = "INV".mt_rand(100000, 9999999).$student->id;
            if($request->admission_fee_status == "PAID"){
                $payment = Payment::create([
                    "amount" => $request->admission_fee,
                    "student_id" => $student->id,
                    "paid_date" => date("Y-m-d H:i:s"),
                    "fee_id" => null,
                    "term_id" => $term->id,
                    "invoice_id" => $invoice_no,
                    "receipt_no" => (env("ADMISSION_NO_PREFIX").$student->id).mt_rand(1000,9999),
                    "academic_year" => env("ACADEMIC_YEAR"),
                    "fee_name" => "ADMISSION FEE",
                    "invoice_no" => $invoice_no,
                    "academic_year_id" => $academic_year?->id
                ]);

                StudentPayment::create([
                    "student_id" => $student->id,
                    "payment_id" => $payment->id,
                    "academic_year_id" => $academic_year->id,
                    "fee_id" => null // check on this later
                ]);
            }

            $student->update([
                "guardian_id" => $guardian?->id,
            ]);

            return [
                "status" => "success",
                "message" => "Student record successfully registered"
            ];
        }catch(Exception $e){
            if($student != null){
                $student->delete();
            }
            Log::error($e);
            return [
                "status" => "error",
                "message" => "Unable to register student. Please try again or contact administrators"
            ];
        }
    }
}