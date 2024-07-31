<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\SClass;
use App\Repositories\Interfaces\FeesRepositoryInterface;
use App\Repositories\Interfaces\TermRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    public FeesRepositoryInterface $feesRepository;
    public TermRepositoryInterface $termRepository;

    public function __construct(FeesRepositoryInterface $feesRepository, TermRepositoryInterface $termRepository)
    {
        $this->feesRepository = $feesRepository;
        $this->termRepository = $termRepository;
    }

    public function fees(){
        $fees = $this->feesRepository->all();
        $terms = $this->termRepository->all();
        $classes = SClass::all();
        return view("app.fees", compact("fees", "classes", "terms"));
    }


    public function saveFee(Request $request){
        $res = $this->feesRepository->createFee($request->fee_name, $request->amount, $request->applies_on, $request->classes);
        return response()->json($res);
    }
}
