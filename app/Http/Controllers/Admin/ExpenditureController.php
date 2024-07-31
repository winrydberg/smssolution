<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Expenditure;
use App\Repositories\Interfaces\ExpenditureRepositoryInterface;

use function PHPUnit\Framework\isInstanceOf;

class ExpenditureController extends Controller
{
    public $expenditureRepository;

    public function __construct(ExpenditureRepositoryInterface $expenditureRepository)
    {
        $this->expenditureRepository = $expenditureRepository;
    }

    public function expenditureCategories(){
        $categories = $this->expenditureRepository->allCategories();
        return view('app.expenditure.expenditure_categories', compact("categories"));
    }

    public function saveNewExpenditureCategory(Request $request){
        $this->expenditureRepository->createCategory($request->name);
        return response()->json([
            "status" => "success",
            "message" => "Expenditure category successfully created"
        ]);
    }

    public function deleteExpenditureCategory(Request $request){
        $res = $this->expenditureRepository->deleteCategory($request->id);
        return response()->json($res);
    }

    public function newExpenditure(){
        $categories = $this->expenditureRepository->allCategories();
        return view("app.expenditure.new_expenditure", compact("categories"));
    }

    public function saveExpenditure(Request $request){
        $res = $this->expenditureRepository->createExpenditure($request);
        if($res instanceof Expenditure){
            return response()->json([
                "status" => "success",
                "message" => "Expenditure successfully saved"
            ]);
        }else{
            return response()->json([
                "status" => "error",
                "message" => "Unable to save expenditure. Please try again"
            ]);
        }
    }
}
