<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\PendingPayment;
use App\Models\SClass;
use App\Models\StudentPayment;
use App\Repositories\Interfaces\AcademicYearRepositoryInterface;
use App\Repositories\Interfaces\FeesRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class FeesRepository implements FeesRepositoryInterface
{
    protected AcademicYearRepositoryInterface $academicyearRepository;
    protected AcademicYearRepositoryInterface $academicYearRepository;

    public function __construct(AcademicYearRepositoryInterface $academicRepo, AcademicYearRepositoryInterface $academicYearRepository)
    {
        $this->academicyearRepository = $academicRepo;
        $this->academicYearRepository = $academicYearRepository;
    }

    public function all(): Collection
    {
       $active_year = $this->academicyearRepository->getActiveAcademicYear();
       $fees = Fee::where("academic_year_id", $active_year?->id)->get();
       foreach($fees as $fee){
            switch($fee->applies_on){
                case "CLASS":
                    $fee->applies_on = SClass::whereIn("id", json_decode($fee->model))->pluck("name")->toArray();
                    continue;
                default:
                    $fee->applies_on = [];
            }
       }
       return $fees;
    }

    public function getTotalPendingFees() : float
    {
        $academic_year = $this->academicYearRepository->getActiveAcademicYear();
        $fees = Fee::where("academic_year_id", $academic_year?->id)->get();
        
        $total_pending = 0; 

        foreach($fees as $fee){
            Student::orderBy("id", "ASC")->chunk(1000, function($students) use($academic_year, $fee, &$total_pending) {
                foreach ($students as $student) {
                    $student_paid_fee = StudentPayment::where("academic_year_id", $academic_year?->id)
                                        ->where("student_id", $student->id)
                                        ->where("fee_id", $fee->id)
                                        ->first();
                    if(is_null($student_paid_fee)){
                        $total_pending += $fee->amount;
                    }
                }
            });
        }
        return $total_pending;
    }

    public function getStudentTotalPendingFees($student_id) : float
    {
        // return PendingPayment::where("academic_year", env("ACADEMIC_YEAR"))->sum("amount");
        $academic_year = $this->academicYearRepository->getActiveAcademicYear();

        // $fees = Fee::where("academic_year_id", $academic_year->id)->get();
        $fees = Fee::all();
        // $fees_paid = StudentPayment::where("academic_year_id", $academic_year->id)->get();

        $unpaid_fee_ids = [];
        foreach ($fees as $fee) {
            //check if fee is specific to a class
            if($fee->applies_on == "CLASS"){
                $applies_on = json_decode($fee->model);
                $student = Student::where("id", $student_id)->first();

                //check if the student class is expected to pay
                if(is_array($applies_on) && in_array($student->class_id, $applies_on)){
                    $fees_paid = StudentPayment::where("academic_year_id", $academic_year->id)
                            ->where("student_id", $student_id)
                            ->where("fee_id", $fee->id)
                            ->first();
                }
            }else{
                $fees_paid = StudentPayment::where("academic_year_id", $academic_year->id)
                            ->where("student_id", $student_id)
                            ->where("fee_id", $fee->id)
                            ->first();
            }
            
            if(is_null($fees_paid)){
                $unpaid_fee_ids[] = $fee->id;
            }
        }
        
        return Fee::whereIn("id", $unpaid_fee_ids)->sum("amount");
    }

    public function getTotalFeesCollected() : float
    {
        return Payment::where("academic_year", env("ACADEMIC_YEAR"))->sum("amount");
    }

    public function createFee($fee_name, $amount, $applies_on, $classes) : array
    {
        try{
           
            $academic_year = $this->academicYearRepository->getActiveAcademicYear();

            if(is_null($academic_year)){
                return [
                    "status" => "error",
                    "message" => "OOps, Please setup and activate an academic year to add fees"
                ];
            }

            Fee::create([
                "name" => $fee_name,
                "amount" => $amount,
                "applies_on" => $applies_on,
                "academic_year" => $academic_year->name,
                "academic_year_id" => $academic_year->id,
                "model" => json_encode($classes)
            ]);

            return [
                "status" => "success",
                "message" => "Fee successfully created"
            ];
        }catch(Exception $e){
            Log::error($e);
            return [
                "status" => "error",
                "message" => "Unable to add fee. Please try again"
            ];
        }
    }

}