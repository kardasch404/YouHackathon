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

    public function deleteProject($userId, $projectId)
    {
        try{
            $user = User::find($userId);
        if(! $user)
        {
            return response()->json([
                'message'=> 'User not found'
            ]);
        }
        $team = Team::where('user_id', $userId)->first();
        if(!$team)
        {
            return response()->json([
                'message' => 'u r not Owner 4 this team !cant delet this project'
            ]);
        }
        $project = Project::find($projectId);
        if(!$project)
        {
            return response()->json([
                'message' => 'Project not found'
            ]);
        }
        $team->project_id = null;
        $team->save();
        $project->delete();
        return response()->json([
            'message' => 'Project deleted success'
        ]);
        }catch(\Exception $e)
        {
            return response()->json([
                'error'=> $e->getMessage(),
                'message'=> 'error deleting project'
            ]);
        }
    }
}
