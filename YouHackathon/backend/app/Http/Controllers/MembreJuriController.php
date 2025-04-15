<?php

namespace App\Http\Controllers;

use App\Models\MembreJuri;
use App\Models\User;
use Illuminate\Http\Request;

class MembreJuriController extends Controller
{
    //

    public function createCodeAndPassword(Request $request, $userId)
    {
        try {
            $user = User::find($userId);
            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ]);
            }
            $isOrganiser = $user->roles()->where('name', 'organiser')->exists();
            if (!$isOrganiser) {
                return response()->json([
                    'message' => 'User not Organiser for this HAckathon'
                ]);
            }

            $authOrganiser = new MembreJuri();
            $authOrganiser->code = $request->code;
            $authOrganiser->password = $request->password;
            $authOrganiser->juri_id = 1;
            $authOrganiser->save();

            return response()->json([
                'message' => 'code && password created seccss',
                'authOrganiser' => $authOrganiser
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error creating code && password',
                'message' => $e->getMessage()
            ]);
        }
    }
}
