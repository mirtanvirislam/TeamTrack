<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Team;
use App\Sprint;

class SprintsController extends Controller
{

    public function store()
    {
        $backlog_id = Team::find(Auth::user()->getCurrentTeamId())->backlog->id;
        $new_sprint_no = count( Team::find(Auth::user()->getCurrentTeamId())->backlog->sprints ) + 1 ;

        Sprint::create([
            'backlog_id'=>$backlog_id, 
            'sprint_no'=>$new_sprint_no, 
            'start_date'=>'2019-08-08 00:00:00', 
            'due_date'=>'2019-08-10 00:00:00'
            ]);

        return response()->json(['message'=>$backlog_id]);
    }


    public function destroy($sprintId)
    {
        $sprint = Sprint::find($sprintId);
        $this->authorize('deleteSprint', $sprint);
        Team::deleteSprint($sprintId);
        return response()->json(['message'=>$sprintId]);
    }
}
