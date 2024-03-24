<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login api
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

       $user = User::where('email', $request->email)->first();
       if(!$user){
              return response()->json(['status'=>'error', 'message' => 'User not found'], 404);
       }

       //check password
       if(!Hash::check($request->password, $user->password)){
              return response()->json(['status'=>'error', 'message' => 'Password not match'], 404);
       }

       //generate token
         $token = $user->createToken('auth_token')->plainTextToken;

         return response()->json(['status'=>'success', 'token' => $token, 'user' => $user],200);


    }

}