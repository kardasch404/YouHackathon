<?php

namespace App\Http\Controllers;

use App\Models\Hackathon;
use App\Models\User;
use Illuminate\Http\Request;

class HackathonController extends Controller
{
    //
    public function createHackathon(Request $request)
    {
        try {
            $organiser = User::find($request->id);
            if (! $organiser) {
                return response()->json([
                    'message' => 'organiser not found'
                ], 404);
            }

            $isOrganiser = $organiser->roles()->where('name', 'organiser')->exists();
            if (! $isOrganiser) {
                return response()->json([
                    'message' => 'User is not an organiser'
                ], 403);
            }

            $hackathon = Hackathon::create([
                'name' => $request->name,
                'description' => $request->description,
                'organiser_id' => $request->id,
            ]);

            return response()->json([
                'message' => 'Hackathon created succes',
                'hackathon' => $hackathon
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating hackathon',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function deleteHackathon($id)
    {
        try {
            $hackathon = Hackathon::find($id);
            if (!$hackathon) {
                return response()->json([
                    'message' => 'Hackathon not found'
                ], 404);
            }
            $hackathon->delete();

            return response()->json([
                'message' => 'Hackathon deleted succes',
                'hackathon' => $hackathon
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting hackathon',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updatehackathon(Request $request, $id)
    {
        $hackathon = Hackathon::find($id);
        if (!$hackathon) {
            return response()->json([
                'message' => 'Hackathon not found'
            ], 404);
        }
        $hackathon->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json([
            'message' => 'Hackathon updated succes',
            'hackathon' => $hackathon
        ], 200);
    }

    public function getHackathons()
    {
        $hackathons = Hackathon::all();
        return response()->json([
            'hackathons' => $hackathons
        ], 200);
    }
}
