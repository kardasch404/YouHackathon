<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
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
            'lastname' =>$request['lastname']
        ]);

        $roleUser = Role::where('name', 'user')->first();

        if ($roleUser) {
            $user->roles()->attach($roleUser->id);
        }
    

        $token = JWTAuth::fromUser($user);
        return response()->json([
            'message'=>'user created seccussefl',
            'user'=>$user,
            'token'=>$token,
        ],200);
    }

    public function login (Request $request)
    {
        $data = $request->only( 'email','password');
        try {
            if ( ! $token = JWTAuth::attempt( $data) )
            {
                return response()->json([
                    'message' => 'error invaled data',
                ],401);
            }

            $user = auth()->user();
            $tokon = JWTAuth::fromUser($user);
            return response()->json([

                'token' => $token
            ]);
        }catch (JWTException $e)
        {
            return response()->json([
                'error' => 'error invaled data'.$e->getMessage(),
            ],500);

        }
    }

    public function logout ()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'message' => 'logout'
        ]);
    }
}
