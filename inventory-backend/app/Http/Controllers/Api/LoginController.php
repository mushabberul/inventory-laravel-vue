<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);


        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $validated = $validator->validate();

        if(Auth::attempt($validated,true)){
            $user = Auth::user();
            $token = $user->createToken('Sabbir')->plainTextToken;
            return response()->json([
                'status'=>true,
                'message'=>'Login Successfully',
                'data'=>[
                    'token'=>$token,
                    'user'=>$user,
                ]
                ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Unauthenticated'
                ]);
        }


    }
}
