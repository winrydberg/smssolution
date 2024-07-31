<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SClass;
use App\Models\Staff;
use App\Models\StaffType;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Matcher\Subset;

class StaffController extends Controller
{
    public function generateStaffNo(): int 
    {
        $staff_no = mt_rand(1000, 9999);
        $staff = Staff::where("staff_no", $staff_no)->first();
        if(!is_null($staff)){
            return $this->generateStaffNo();
        }
        return $staff_no;
    }

    public function newStaff(){
        $subjects = Subject::all();
        $staff_types = StaffType::all();
        $classes = SClass::all();
        $staff_no = $this->generateStaffNo();
        return view("app.new_staff", compact("staff_types", "subjects", "classes", "staff_no"));
    }

    public function staffTypes(){
        $staff_types = StaffType::withCount("staffs")->get();
        return view("app.staff_types", compact("staff_types"));
    }

    public function saveStaffCategory(Request $request){
        try{
            StaffType::create([
                "name" => $request->category_name
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Record successfully saved."
            ]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Unable to create staff type / category. Please try again"
            ]);
        }
    }

    public function deleteStaffCategory(Request $request){
        try{
            $category = StaffType::where("id",)->first();
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                "status" => "error",
                "message" => "Unable to delete staff type / category. Please try again"
            ]);
        }
    }

    public function saveNewStaff(Request $request){
        try {
            $staff_type = StaffType::where("name", $request->staff_type)->first();
            $staff = Staff::create([
                "staff_no" => $request->staff_no,
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "email" => $request->email,
                "phone" => $request->phone,
                "photo" => $request->image_src,
                "basic_salary" => $request->basic_salary,
                "staff_type_id" => $staff_type->id,
                "staff_type" => $request->staff_type,
                "active" => true
            ]);
            $class_data = $request->class_data;
            foreach($class_data as $d){
                DB::table("staff_subject")->insert([
                    "subject_id" => $d['subject_id'],
                    "staff_id" => $staff->id,
                    "class_id" => $d['class_id'],
                    "created_at" => date("Y-m-d h:i:s"),
                    "updated_at" => date("Y-m-d h:i:s"),
                ]);
            }
            return response()->json([
                "status" => 'success',
                "message" => "Staff record successfully created"
            ]);

        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                "status" => "error",
                "message" => "Unable to create staff. Please try again"
            ]);
        }
    }


    public function staffList(){
        $staffs = Staff::with("staff_type")->get();
        return view("app.staff_list", compact("staffs"));
    }
}
