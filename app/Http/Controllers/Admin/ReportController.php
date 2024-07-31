<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ExpenditureRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\ReportsRepositoryInterface;
use App\Repositories\Interfaces\SClassRepositoryInterface;
use App\Repositories\Interfaces\TermRepositoryInterface;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $expenditureRepository;
    protected $termRepository;
    protected $classRepository;
    protected $paymentRepository;
    protected $reportRepository;


    public function __construct(
        ExpenditureRepositoryInterface $expenditureRepository, 
        TermRepositoryInterface $termRepository,
        SClassRepositoryInterface $classRepository,
        PaymentRepositoryInterface $paymentRepository,
        ReportsRepositoryInterface $reportRepository,
    ){
        $this->expenditureRepository = $expenditureRepository;
        $this->termRepository = $termRepository;
        $this->classRepository = $classRepository;
        $this->reportRepository = $reportRepository;
    }
    //
    public function expenditureReports(Request $request){
        $reports = $this->expenditureRepository->getExpenditureReports($request);
        $academic_years = $this->expenditureRepository->getAcademicYears();
        $terms = $this->termRepository->all();
        $jsonData = json_encode($reports["chart_data"]);
        $expenditures = $reports["expenditures"];

        return view('app.reports.expenditure', compact("terms","academic_years", "jsonData", "expenditures"));
    }

    public function revenueReports(Request $request){
        $terms = $this->termRepository->all();
        $classes = $this->classRepository->all();
        $sub_classes = $this->classRepository->subClasses();
        $academic_years = $this->reportRepository->getAcademicYears();
        $reports = $this->reportRepository->generateReport($request);
        $payments = $reports["payments"];
        $jsonData = json_encode($reports["chart_data"]);
        return view('app.reports.revenue', compact("terms","academic_years", "jsonData", "payments", "classes", "sub_classes"));
    }

}
