<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guardian;
use App\Models\Payment;
use App\Models\PendingPayment;
use App\Models\SClass;
use App\Models\Student;
use App\Models\SubClass;
use App\Models\Term;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\Interfaces\SClassRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\Interfaces\AcademicYearRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    protected $studentRepository;
    protected $invoiceRepository;
    protected $classRepository;
    protected $academicRepository;

    public function __construct(
        StudentRepositoryInterface $studentRepository,
        SClassRepositoryInterface $classRepository,
        AcademicYearRepositoryInterface $academicRepository
    ){
        $this->studentRepository = $studentRepository;
        $this->classRepository = $classRepository;
        $this->academicRepository = $academicRepository;
    }
    


    public function newStudent(){
        $classes = SClass::all();
        $sub_classes = SubClass::all();
        $guardians = Guardian::all();
        $admission_no = $this->studentRepository->generateAdmissionNo();
        return view("app.new_student", compact("classes", "sub_classes", "admission_no", "guardians"));
    }

    public function getStudents(){
        $students = $this->studentRepository->all();
        return response()->json([
            "status" => 'success',
            "students" => $students,
        ]);
    }

    public function getGuardian(Request $request){
        $guardian = Guardian::where("id", $request->query("guardian_id", null))->first();
        if(!is_null($guardian)){
            return response()->json([
                "status" => "success",
                "parent" => $guardian,
                "message" => "Guardian successfully retrieved"
            ], 200);
        }else{
            return response()->json([
            ]);
        }
    }

    public function saveNewStudent(Request $request){
        $res = $this->studentRepository->createStudent($request);
        return response()->json($res);
    }


    public function students(Request $request){
        $search  = $request->query("search", 0);
        if($search != 0 && $search == 1){
            $admission_no = $request->query("admissionno", "");
            $student_name = $request->query("name", "");
            $class = $request->query("class", "");
            $students = $this->studentRepository->searchStudents($admission_no, $student_name, $class);
        }else{
            $students = $this->studentRepository->all();
        }
        $classes = $this->classRepository->all();
        return view("app.students.students", compact("students", 'classes'));
    }


    public function studentDetails(Request $request){
        $student = $this->studentRepository->find($request->sid);
        $total_pending_fees = $this->studentRepository->calculatePendingFees($request->sid);
        $fees_pending = $this->studentRepository->getStudentPendingFees($request->sid);


        return view("app.students.student_details", compact("student", "total_pending_fees", "fees_pending"));
    }
}
