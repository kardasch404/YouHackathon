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

    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();
        return response()->json([
            'message' => 'Role deleted success',
            'role' => $role
        ]);
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
