<?php

namespace App\Repositories;

use App\Helpers\EnvUpdater;
use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\Fee;
use App\Repositories\Interfaces\AcademicYearRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AcademicYearRepository implements AcademicYearRepositoryInterface
{
    public function all(): Collection
    {
       return AcademicYear::orderBy('id', 'DESC')->get();
    }

    public function getYears() : array
    {
        $start_year = env("ACADEMIC_START_YEAR");
        $years = [];
        for($i = $start_year; $i <= date('Y'); $i++){
            $years[] = $i;
        }
        return $years;
    }

    public function saveAcademicYear($year_one, $year_two) : array
    {
        try{
            $academic_year = AcademicYear::where("name", $year_one.'/'.$year_two)->first();
            if($academic_year){
                return ['status' => 'error', 'message' => "Academic year already exist."];
            }
            AcademicYear::create([
                "name" => $year_one.'/'.$year_two
            ]);
            return ['status' => 'success', 'message' => "Academic year successfully created"];
        }catch(Exception $e){
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function activateAcademicYear($id) : array
    {
        try{
            AcademicYear::where("id",$id)->update([
                "active" => true
            ]);
            AcademicYear::where("id", "!=",$id)->update([
                "active" => false
            ]);
            $academic_year = AcademicYear::where("id",$id)->first();
            if(!is_null($academic_year)){
                EnvUpdater::update("ACADEMIC_YEAR", $academic_year->name);
            }
            return ['status' => 'success', 'message' => "Academic year successfully activated"];
        }catch(Exception $e){
            return ['status' => 'error', 'message' => "ERR: unable to activate academic year".$e->getMessage()];
        }
    }

    public function getActiveAcademicYear() : AcademicYear | null
    {
        return AcademicYear::where("active", true)->first();
    }


}