<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //

    public function createTeam(Request $request, $userId, $editionId)
    {
       try{
        $user = User::find($userId);
        if (!$user) {
            return response()->json(
                [
                    'message' => 'User not found'
                ],
                404
            );
        }
        $Isparticipant = $user->roles()->where('name', 'participant')->exists();
        if (!$Isparticipant) {
            return response()->json(
                [
                    'message' => 'User is not a participant'
                ],
                400
            );
        }
        $edition = Edition::find($editionId);
        if (!$edition) {
            return response()->json(
                [
                    'message' => 'Edition not found'
                ],
                404
            );
        }
        $isParticipantAuxThisEdition = $user->editions()->where('edition_id', $editionId)->exists();

        if (!$isParticipantAuxThisEdition) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not participier on this Edition'
            ], 400);
        }

       $team = new Team();
       $team->name = $request->name;
       $team->edition_id = $editionId;
       $team->user_id = $userId;
       $team->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Team created successfully',
            'user' => $user,
            'team' => $team
        ], 201);
       }catch(\Exception $e){
        return response()->json([
            'status' => 'error',
            'message' => 'Error creating team',
            'error' => $e->getMessage()
        ], 500);
       }
    }
}
