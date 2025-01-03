<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginUser(Request $request){
        $validatedData = Validator::make($request->all(),[
            'email'=>'required|email|string|exists:users,email',
            'password'=>'required|string|min:6'
        ]);

        if($validatedData->fails()){
            return response()->json(['status'=>400,'message'=>$validatedData->errors()->first()]);
        }

        // //Get the Validated Data
        $validatedData = $validatedData->validated();
        
        //Credentials
        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ];

        // Check User
        if(Auth::attempt($credentials)){
            if(Auth::user()->hasRole('admin')){
                return response()->json([
                    'status'=>200,
                    'message'=>'Login Successfully!!!',
                    'url'=>'admin/dashboard'
                ]);
            }else{
                return response()->json([
                    'status'=>200,
                    'message'=>'Not Admin'
                ]);
            }
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Wrong Credentials'
            ]);
        }
    }
}
