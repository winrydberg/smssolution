<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SClass;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Term;
use App\Repositories\Interfaces\ExpenditureRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $paymentRepository;
    protected $expenditureRepository;

    public function __construct(
        PaymentRepositoryInterface $paymentRepository,
        ExpenditureRepositoryInterface $expenditureRepository
    ){
        $this->paymentRepository = $paymentRepository;
        $this->expenditureRepository = $expenditureRepository;
    }
   

    public function dashboard(){
        $student_count = Student::where("active", true)->count();
        $staff_count = Staff::count();
        $classes_count = SClass::count();
        $term = Term::where("active", true)->first();
        $payments = $this->paymentRepository->getLatest(100);
        $total_fees = $this->paymentRepository->calculateThisTermFees();
        $jsonData = json_encode($this->expenditureRepository->generateChartData());
        return view("app.dashboard", compact("student_count", "staff_count", "classes_count", "payments", "total_fees", "term", "jsonData"));
    }
}
