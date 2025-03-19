<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthController extends Controller
{
    //

    public function register (Request $request)
    {
       $user = User::create([
            'email' =>$request['email'],
            'password' =>Hash::make($request['password']),
            'firstname' =>$request['firstname'],
            'lastname' =>$request['lastname'],
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json([
            'message'=>'user created seccussefl',
            'user'=>$user,
            'token'=>$token,
        ],200);
    }
}
