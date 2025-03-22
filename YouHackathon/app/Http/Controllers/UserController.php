<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function addUserRole(Request $request)
    {

        try{
            $user = User::find($request->id);
            if (!$user){
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404); 
            }

            $role = Role::find($request->role_id);
            if (!$role){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Role not found'
                ], 404);
            }
            $user->roles()->attach($request->role_id);
            $roles = $user->roles()->get(['roles.id', 'roles.name']);;

            return response()->json([
                'status' => 'success',
                'message' => 'Role added success',
                'user' => $user,
                'data' => $roles
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }

    }
}
