<?php

namespace App\Http\Controllers;

use App\Models\MembreJuri;
use App\Models\Note;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    //
    public function evaluateTeam(Request $request, $memberJuriId, $teamId)
    {
        try {
            $memberJuri = MembreJuri::find($memberJuriId);
            if (!$memberJuri) {
                return response()->json([
                    'message' => 'memberJuri note foud'
                ]);
            }
            $team = Team::find($teamId);
            if (!$team) {
                return response()->json([
                    'message' => 'team note foud'
                ]);
            }
            $teamProject = $team->project_id;
            if (!$teamProject) {
                return response()->json([
                    'message' => 'team project note foud'
                ]);
            }
            $project = Project::find($teamProject);
            if (!$project) {
                return response()->json([
                    'message' => 'project note foud'
                ]);
            }

            // return response()->json([
            //     'project'=> $project,
            //     'team'=> $team,
            //     'memberJuri'=> $memberJuri
            // ]);
            $note = new Note();
            $note->score = $request->score;
            $note->comment = $request->comment;
            $note->membreJuri_id = $memberJuriId;
            $note->team_id = $teamId;
            $note->save();

            return response()->json([
                'project' => $project,
                'team' => $team,
                'memberJuri' => $memberJuri,
                'note' => $note
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
