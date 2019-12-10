<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Team;
use App\Task;
use App\User;

class TeamsController extends Controller
{

    
    public function index() //delete this later
    {
       return redirect('/home');
    }


    public function masterindex()
    {
        $teams = Team::all();
        //return view('teams.index')->with('teams',$teams);        
        return redirect('/home');
    }


    public function create() // delete later
    {
        return redirect('/home');
    }
    

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);

        $team_name = $request->input('name');
        $leader_id = Auth::id();
        $newTeam = Team::createTeam($team_name, $leader_id);
        Auth::user()->setCurrentTeamId($newTeam->id);

        return redirect('/home');
    }


    public function show($id)
    {

        $team = Team::find($id);
        $this->authorize('viewTeam', $team);
        Auth::user()->setCurrentTeamId($id);

        $members = Team::find(Auth::user()->getCurrentTeamId())->members;
        $membersArray;

        foreach($members as $member)
        {
            $membersArray[$member->id] = $member->name;
        }

        $total_task_count = 0;
        $completed_task_count = 0;
        $incomplete_task_count = 0;

        foreach($team->backlog->sprints as $sprint)
        {
            $total_task_count += count($sprint->tasks);

            foreach($sprint->tasks as $task)
            {
                if($task->is_completed)
                {
                    $completed_task_count++;
                }
            }
        }

        
        return view('teams.show')->with('team',$team)->with('members', $membersArray)->with('total_task_count', $total_task_count)->with('completed_task_count',$completed_task_count);
    }

    public function destroy($id)
    {
        Team::deleteTeam($id);
        Auth::user()->setCurrentTeamId(0);
        return redirect('\home');
    }

}
