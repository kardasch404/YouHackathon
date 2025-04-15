<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

    public function create(Request $request)
    {
        $role = Role::create([
            'name' => $request->name
        ]);
        return response()->json([
            'message' => 'Role created success',
            'role' => $role
        ]);
    }

    public function deleteRole($id)
    {
        try {
            $role = Role::find($id);
            if (!$role) {
                return response()->json([
                    'message' => 'Role not found'
                ], 404);
            }

            $role->delete();

            return response()->json([
                'message' => 'Role deleted success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting role',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->update([
            'name' => $request->name
        ]);
        return response()->json([
            'message' => 'Role updated success',
            'role' => $role
        ]);
    }
    public function getAllRole()
    {
        $role = Role::all();
        return response()->json([
            "message" => $role
        ]);
    }
}
