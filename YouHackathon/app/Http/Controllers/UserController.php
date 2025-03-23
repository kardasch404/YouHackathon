<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //

    public function addUserRole(Request $request)
    {

        try {
            $user = User::find($request->id);
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }

            $role = Role::find($request->role_id);
            if (!$role) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Role not found'
                ], 404);
            }

            if ($user->roles()->where('roles.id', $request->role_id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'user has already this'
                ], 400);
            }
            $user->roles()->attach($request->role_id);
            $roles = $user->roles()->get(['roles.id', 'roles.name']);;

            return response()->json([
                'status' => 'success',
                'message' => 'Role added success',
                'user' => $user,
                'data' => $roles
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function participierAuxEdition($userId, $editionId)
    {
        try {

            $user = User::find($userId);
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }
            $isUser = $user->roles()->where('name', 'user')->exists();
            if (! $isUser) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User has another role'
                ], 404);
            }
            $edition = Edition::find($editionId);
            if (!$edition) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Edition not found'
                ], 404);
            }

            if ($user->editions()->where('edition_id', $editionId)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User has already registered for this Edition'
                ], 400);
            }

            DB::beginTransaction();
            try {
                $user->editions()->attach($editionId);
                $participnatRole = Role::where('name', 'participant')->first();
                if (!$user->roles()->where('roles.id', $participnatRole->id)->exists()) {
                    $user->roles()->attach($participnatRole->id);
                }

                DB::commit();
                $user->load('editions', 'roles');
                return response()->json([
                    'status' => 'success',
                    'message' => 'User registered to edition success',
                    'user' => $user,
                    'edition' => $edition
                ], 200);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}


