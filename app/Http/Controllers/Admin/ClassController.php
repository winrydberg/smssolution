<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SClass;
use App\Models\SubClass;
use App\Repositories\Interfaces\SClassRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassController extends Controller
{
    public $classRespository;

    public function __construct(SClassRepositoryInterface $classRespository)
    {
        $this->classRespository = $classRespository;
    }
    public function classes(){
        $classes = SClass::with("class_subcategories")->withCount("students")->get();
        $sub_classes = SubClass::all();

        // return response()->json(
        // [
        //     "status" => "success",
        //     "data" => $classes
        // ],200);
        return view("app.classes", compact("classes", "sub_classes"));
    }

    public function newClass(Request $request){
        try{
            $class_name = $request->class_name;
            $categories = $request->category;
            $class = SClass::create([
                "name" => $class_name,
            ]);
            foreach($categories as $cat){
                DB::table("class_sub_category")->insert([
                    "class_id" => $class->id,
                    "sub_class_id" => $cat
                ]);
            }
            return response()->json([
                "status" => "success",
                "message" => "Class successfully created"
            ]);
        }catch(Exception $e){
            Log::error($e);
            return response()->json([
                "status" => "error",
                "message" => "Unable to create class. Please try again"
            ]);
        }
    }

    public function deleteClass(Request $request){
        try{
            $class = SClass::where("id", $request->id)->withCount("students")->first();
            if(!is_null($class) && $class?->student_count <= 0){
                $class->delete();
                return response()->json([
                    "status" => "success",
                    "message" => "Class record successfully deleted"
                ]);
            }else{
                return response()->json([
                    "status" => "error",
                    "message" => "Unable to delete class record. Class may contain students and therefore cannot be deleted"
                ]);
            }
        }catch(Exception $e){
            Log::error($e);
            return response()->json([
                "status" => "error",
                "message" => "Unable to delete class. Please try again"
            ]);
        }
    }


    public function students(Request $request){
        $students = $this->classRespository->getStudents($request->query("classid", null));
        $class = $this->classRespository->find($request->query("classid", null));
        return view("app.students.class_students", compact("students", "class"));
    }
}
