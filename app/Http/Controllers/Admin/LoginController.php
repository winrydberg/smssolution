<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(){
        return view("app.login");
    }

    public function authenticateUser(Request $request){
        try{

            $user = User::where("email", $request->email)->first();
            if(is_null($user)){
                return response()->json([
                    "status" => "error",
                    "message" => "User account with email ".$request->email." NOT found."
                ]);
            }
            $credentials = [
                "email" => $request->email,
                "password" => $request->password
            ];

            if(Auth::attempt($credentials)){
                return response()->json([
                    "status" => "success",
                    "message" => "Login successful",
                    "dashboard" => Session::get('url.intended', '/dashboard')
                ]);
            }else{
                return response()->json([
                    "status" => "error",
                    "message" => "Invalid Login Credentials"
                ]);
            }

        }catch(Exception $e){
            Log::error($e);
            return response()->json([
                "status" => "error",
                "message" => "Unable to login. Please try again"
            ]);
        }
    }

    public function logoutUser(){
        Auth::logout();
        return redirect()->to("/login");
    }
}
