<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function createProject(Request $request,$userId)
    {
        try{
            $user = User::find($userId);
        if( ! $user)
        {
            return response()->json([
                'message' => 'User not found'
            ]);
        }
        $team = Team::where('user_id', $userId)->first();
        if(!$team)
        {
            return response()->json([
                'message' => 'User not Owner 4 this team'
            ]);
        }
        $project = Project::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'lien'=> $request->lien,
        ]);
        // $team->update([
        //     'project_id'=>$project->id
        // ]);
        $team->project_id = $project->id;
        $team->save();
        return response()->json([
            'message'=> 'seccs craeting project',
            'project'=> $project,
            'team'=> $team
        ]);
        
        }catch(\Exception $e)
        {
            return response()->json([
                'error'=> $e->getMessage(),
                'message'=> 'error craeting project'
            ]);
        }

    }
}
