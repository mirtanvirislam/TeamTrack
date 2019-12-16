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
        $sprint_array;
        $completed_task_array;
        $overdue_task_array;
        $scheduled_task_array;
        $i = 0;

        foreach($team->backlog->sprints as $sprint)
        {
            $total_task_count += count($sprint->tasks);
            $sprint_array[$i] = $sprint->sprint_no;
            $completed_task_on_current_sprint = 0;
            $overdue_task_on_current_sprint = 0;
            $scheduled_task_on_current_sprint = 0;

            foreach($sprint->tasks as $task)
            {
                if($task->due_date < date('Y-m-d'))
                {
                    if($task->is_completed)
                    {
                        $completed_task_count++;
                        $completed_task_on_current_sprint++;
                    }
                    else
                    {
                        $overdue_task_on_current_sprint++;
                    }
                }
                else
                {
                    if($task->is_completed)
                    {
                        $completed_task_count++;
                        $completed_task_on_current_sprint++;
                    }
                    else
                    {
                    $scheduled_task_on_current_sprint++;
                    }
                }
            }
            $completed_task_array[$i] = $completed_task_on_current_sprint;
            $overdue_task_array[$i] = $overdue_task_on_current_sprint;
            $scheduled_task_array[$i] = $scheduled_task_on_current_sprint;
            $i++;
        }

        
        return view('teams.show')
            ->with('team',$team)
            ->with('members', $membersArray)
            ->with('total_task_count', $total_task_count)
            ->with('completed_task_count',$completed_task_count)
            ->with('sprints', $sprint_array)
            ->with('completed_task_array',$completed_task_array)
            ->with('overdue_task_array',$overdue_task_array)
            ->with('scheduled_task_array',$scheduled_task_array);
    }

    public function destroy($id)
    {
        Team::deleteTeam($id);
        Auth::user()->setCurrentTeamId(0);
        return redirect('\home');
    }

}
