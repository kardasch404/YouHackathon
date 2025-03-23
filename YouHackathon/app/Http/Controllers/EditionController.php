<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\User;
use Illuminate\Http\Request;

class EditionController extends Controller
{
    //

    public function createEdition(Request $request, $id)
    {

        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            }
            $isOrganiser = $user->roles()->where('name', 'organiser')->exists();
            if (! $isOrganiser) {
                return response()->json([
                    'message' => 'User is not an organizer'
                ], 404);
            }
            $edition = new Edition();
            $edition->theme = $request->theme;
            $edition->year = $request->year;
            $edition->lieu = $request->lieu;
            $edition->startDate = $request->startDate;
            $edition->endDate = $request->endDate;
            $edition->hackathon_id = 1;
            $edition->organiser_id = $id;
            $edition->save();
            return response()->json([
                'message' => 'Edition created success',
                'edition' => $edition
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Edition not created',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteEdition($userId, $editionId)
    {
        try {
            $user = User::find($userId);
            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            }
            $isOrganiser = $user->roles()->where('name', 'organiser')->exists();
            if (! $isOrganiser) {
                return response()->json([
                    'message' => 'User is not an organizer'
                ], 404);
            }
            $edition = Edition::find($editionId);
            if (!$edition) {
                return response()->json([
                    'message' => 'Edition not found'
                ], 404);
            }
            if ($edition->organiser_id != $userId) {
                return response()->json([
                    'message' => 'User is not authorized to delete this edition'
                ], 403);
            }
            $edition->delete();
            return response()->json([
                'message' => 'Edition deleted success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Edition not deleted',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
