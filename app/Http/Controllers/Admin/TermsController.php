<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use App\Repositories\Interfaces\AcademicYearRepositoryInterface;
use App\Repositories\Interfaces\TermRepositoryInterface;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    protected $termRepository;
    protected $academicYearRepository;

    public function __construct(TermRepositoryInterface $termRepository, AcademicYearRepositoryInterface $academicYearRepository)
    {
        $this->termRepository = $termRepository;
        $this->academicYearRepository = $academicYearRepository;
    }
    public function terms(){
        $terms = $this->termRepository->all();
        $academic_years = $this->academicYearRepository->all();
        $years = $this->academicYearRepository->getYears();
        return view("app.terms", compact("terms", "academic_years", "years"));
    }

    public function activateTerm(Request $request){
        $res = $this->termRepository->activateTerm(($request));
        return response()->json($res);
    }

    public function saveAcademicYear(Request $request){
        $res = $this->academicYearRepository->saveAcademicYear($request->year_one, $request->year_two);
        return response()->json($res);
    }

    public function activateAcademicYear(Request $request){
        $res = $this->academicYearRepository->activateAcademicYear($request->id);
        return response()->json($res);
    }
}
