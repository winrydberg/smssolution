<?php

namespace App\Repositories;

use App\Models\Expenditure;
use App\Models\ExpenditureCategory;
use App\Models\Student;
use App\Models\Fee;
use App\Models\Term;
use App\Repositories\Interfaces\ExpenditureRepositoryInterface;
use App\Repositories\Interfaces\TermRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenditureRepository implements ExpenditureRepositoryInterface
{
    protected $termRepo;

    public function __construct(TermRepositoryInterface $termRepo)
    {
        $this->termRepo = $termRepo;
    }

    public function all(): Collection
    {
       return Expenditure::all();
    }

    public function allCategories(): Collection
    {
        return ExpenditureCategory::withCount("expenditures")->get();
    }

    public function createCategory(string $name)  :  ExpenditureCategory
    {
        return ExpenditureCategory::create([
            "name" => $name
        ]);
    }

    public function deleteCategory(int $id) : array
    {
        ExpenditureCategory::find($id)->delete();
        return [
            "status" => "success",
            "message" => "Expenditure category successfully deleted"
        ];
    }

    public function createExpenditure(Request $request) : Expenditure
    {
        $term = Term::where("active", true)->first();
        $academic_year = env("ACADEMIC_YEAR");
        return Expenditure::create([
            "description" => $request->description,
            "term_id" => $request->term != null ? $request->term : $term->id,
            "academic_year" => $academic_year,
            "expenditure_category_id" => $request->category,
            "amount" => $request->amount,
            "date_spent" => $request->spent_date
        ]);
    }

    public function generateChartData() : array
    {
        $term = Term::where("active", true)->first();
        $expenditures = Expenditure::select('expenditure_category_id', DB::RAW('SUM(amount) as total_amount'))
                        ->where("term_id", $term->id)
                        ->groupBy("expenditure_category_id")
                        ->get();
        // dd($expenditures);
        $labels = [];  
        $data = [];              
        foreach($expenditures as $e){
            $cat = ExpenditureCategory::where("id", $e->expenditure_category_id)->first();
            if(!is_null($cat)){
                $labels[] = $cat->name;
                $data[] = $e->total_amount;
            }
        }
    
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Expenditure '.'('.env('CURRENCY').')',
                    'backgroundColor' => ['rgba(75, 192, 192, 0.2)', 'rgba(75, 44, 192, 0.2)'],
                    'borderColor' => ['rgba(75, 192, 192, 1)', 'rgba(75, 44, 192, 1)'],
                    'borderWidth' => 1,
                    'data' => $data,
                ]
            ]
        ];
    }


    public function getAcademicYears() : Collection
    {
        return Expenditure::select("academic_year")->distinct("academic_year")->get();
    }


    public function getExpenditureReports(Request $request) : array
    {
        try{
            $search = $request->query("search", null);
            if($search != null && $search != 0){
                $startdate = $request->query("startdate", null);
                $enddate = $request->query("enddate", null);
                $term = $request->query("term", null);
                $academic_yr = $request->query("academic_yr", null);
                $chart_data = Expenditure::select('expenditure_category_id', DB::RAW("SUM(amount) as total_amount"))
                                ->when($startdate != null, function($query) use($startdate){
                                    $query->where("date_spent", ">=", $startdate);
                                })
                                ->when($enddate != null, function($query) use($enddate){
                                    $query->where("date_spent", "<=", $enddate);
                                })
                                ->when($term != null, function($query) use($term){
                                    $query->where("term_id", $term);
                                })
                                ->when($academic_yr != null, function($query) use($academic_yr){
                                    $query->where("academic_year", $academic_yr);
                                })
                                ->groupBy("expenditure_category_id")
                                ->get();
                $expenditures = Expenditure::with("category")->when($startdate != null, function($query) use($startdate){
                                    $query->where("date_spent", ">=", $startdate);
                                })
                                ->when($enddate != null, function($query) use($enddate){
                                    $query->where("date_spent", "<=", $enddate);
                                })
                                ->when($term != null, function($query) use($term){
                                    $query->where("term_id", $term);
                                })
                                ->when($academic_yr != null, function($query) use($academic_yr){
                                    $query->where("academic_year", $academic_yr);
                                })
                                ->get();
                                            
                $data = $this->formatChartData($chart_data);
                
                return [
                    "status" => "success",
                    "chart_data" => $data,
                    "expenditures" => $expenditures,
                    "message" => "Reports generated"
                ];
            }else{
                $term = $this->termRepo->getActiveTerm();
                $chart_data = Expenditure::select('expenditure_category_id', DB::RAW("SUM(amount) as total_amount"))
                                ->where("term_id",$term->id)
                                ->where("academic_year", env("ACADEMIC_YEAR"))
                                ->groupBy("expenditure_category_id")
                                ->get();
                $expenditures = Expenditure::with("category")
                                ->where("term_id",$term->id)
                                ->where("academic_year", env("ACADEMIC_YEAR"))
                                ->get();
                $data = $this->formatChartData($chart_data);
                return [
                    "status" => "success",
                    "chart_data" => $data,
                    "expenditures" => $expenditures,
                    "message" => "Reports generated"
                ];
            }
        }catch(Exception $e){
            return [
                "status" => "error",
                "message" => "Unable to generate reports"
            ];
        }
    }



    public function formatChartData($expenditures) : array
    {
        $labels = [];  
        $data = [];  
        foreach($expenditures as $e){
            $cat = ExpenditureCategory::where("id", $e->expenditure_category_id)->first();
            if(!is_null($cat)){
                $labels[] = $cat->name;
                $data[] = $e->total_amount;
            }
        }
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Expenditure '.'('.env("CURRENCY").')',
                    'backgroundColor' => ['rgba(75, 192, 192, 0.2)', 'rgba(75, 44, 192, 0.2)'],
                    'borderColor' => ['rgba(75, 192, 192, 1)', 'rgba(75, 44, 192, 1)'],
                    'borderWidth' => 1,
                    'data' => $data,
                ]
            ]
        ];
    }


}