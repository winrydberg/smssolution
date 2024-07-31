<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Fee;
use App\Models\Payment;
use App\Repositories\Interfaces\FeesRepositoryInterface;
use App\Repositories\Interfaces\ReportsRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\Interfaces\TermRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsRepository implements ReportsRepositoryInterface
{
    protected $termRepo;
    protected $studentsRepo;

    public function __construct(TermRepositoryInterface $termRepo, StudentRepositoryInterface $studentsRepo)
    {
       $this->termRepo = $termRepo; 
       $this->studentsRepo = $studentsRepo;
    }

    public function generateReport(Request $request): array
    {
        try{
            $search = $request->query("search", null);
            if($search != null && $search != 0){
                $startdate = $request->query("start", null);
                $enddate = $request->query("end", null);
                $term = $request->query("term", null);
                $class = $request->query("mclass", null);
                $sub_class = $request->query("sclass", null);
                $academic_yr = $request->query("acad_yr", null);

                $chart_data = Payment::select('fee_name', DB::RAW("SUM(amount) as total_amount"))
                                ->when($startdate != null, function($query) use($startdate){
                                    $query->where("paid_date", ">=", $startdate);
                                })
                                ->when($enddate != null, function($query) use($enddate){
                                    $query->where("paid_date", "<=", $enddate);
                                })
                                ->when($term != null, function($query) use($term){
                                    $query->where("term_id", $term);
                                })
                                ->when($class != null, function($query) use($class){
                                    $query->where("class_id", $class);
                                })
                                ->when($sub_class != null, function($query) use($sub_class){
                                    $query->where("sub_class_id", $sub_class);
                                })
                                ->when($academic_yr != null, function($query) use($academic_yr){
                                    $query->where("academic_year", $academic_yr);
                                })
                                ->groupBy("fee_name")
                                ->get();
                $payments = Payment::when($startdate != null, function($query) use($startdate){
                                    $query->where("paid_date", ">=", $startdate);
                                })
                                ->when($enddate != null, function($query) use($enddate){
                                    $query->where("paid_date", "<=", $enddate);
                                })
                                ->when($term != null, function($query) use($term){
                                    $query->where("term_id", $term);
                                })
                                ->when($class != null, function($query) use($class){
                                    $query->where("class_id", $class);
                                })
                                ->when($sub_class != null, function($query) use($sub_class){
                                    $query->where("sub_class_id", $sub_class);
                                })
                                ->when($academic_yr != null, function($query) use($academic_yr){
                                    $query->where("academic_year", $academic_yr);
                                })
                                ->get();
                                            
                $data = $this->formatChartData($chart_data);
                
                return [
                    "status" => "success",
                    "chart_data" => $data,
                    "payments" => $payments,
                    "message" => "Reports generated"
                ];
            }else{
                $term = $this->termRepo->getActiveTerm();
                $chart_data = Payment::select('fee_name', DB::RAW("SUM(amount) as total_amount"))
                                ->where("term_id",$term->id)
                                ->where("academic_year", env("ACADEMIC_YEAR"))
                                ->groupBy("fee_name")
                                ->get();
                $payments = Payment::with("category")
                                ->where("term_id",$term->id)
                                ->where("academic_year", env("ACADEMIC_YEAR"))
                                ->get();
                $data = $this->formatChartData($chart_data);
                return [
                    "status" => "success",
                    "chart_data" => $data,
                    "payments" => $payments,
                    "message" => "Reports generated"
                ];
            }
        }catch(Exception $e){
            return [
                "status" => "success",
                "chart_data" => [],
                "payments" => [],
            ];
        }
    }


    public function formatChartData($payments) : array
    {
        $labels = [];  
        $data = [];  
        foreach($payments as $e){
            $labels[] = $e->fee_name;
            $data[] = $e->total_amount;
        }
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Revenue '.'('.env("CURRENCY").')',
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
        return Payment::distinct("academic_year")->get();
    }

    public function generateGenderChart() : array
    {
        $records = Student::where("active", true)
                    ->select("gender", DB::raw("count(*) as total"))
                    ->groupBy("gender")
                    ->get();
        $labels = [];
        $data = [];
        foreach($records as $r){
            $labels[] = $r->gender;
            $data[] = $r->total;
        }
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'TOTAL ',
                    'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)'],
                    'borderColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)'],
                    'borderWidth' => 1,
                    'data' => $data,
                ]
            ]
        ];
        return [];
    }
}