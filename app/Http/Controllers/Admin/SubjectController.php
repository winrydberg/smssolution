<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
    public function subjects(){
        $subjects = Subject::all();
        return view("app.subjects", compact("subjects"));
    }

    public function newSubject(Request $request){
        try{
            Subject::create([
                "name" => $request->subject_name,
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Subject successfully created"
            ]);
        }catch(Exception $e){
            Log::error($e);
            return response()->json([
                "status" => "error",
                "message" => "Unable to create subject. Please try again"
            ]);
        }
    }

    public function deleteSubject(Request $request){
        try{
            Subject::where("id", $request->id)->delete();
            return response()->json([
                "status" => "success",
                "message" => "Subject record successfully deleted"
            ]);
        }catch(Exception $e){
            Log::error($e);
            return response()->json([
                "status" => "error",
                "message" => "Unable to delete class. Please try again"
            ]);
        }
    }


}
