<?php

use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Task;
use App\Team;
use Validator;

class TasksController extends Controller
{

    public function index()
    {
        return redirect('/home');
    }


    public function create($sprintId)
    {
        return redirect('/home');
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required',
            'sprintId'=>'required',
            'assignedTo'=>'required',
        ]);

        if ($validator->passes()) {

            //Create Task 
            $title = $request->title;
            $description = $request->description;
            $sprintId = $request->sprintId;
            $assignedTo = $request->assignedTo;
            Task::createTask($sprintId, $assignedTo, Auth::id(), $title, $description); //TODO : change input
            return response()->json(['message'=>'done']);
        }
        else if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

    }


    public function show($id)
    {
        //fetching task data from the task table database
        //$task= Task::find($id);
        //return view('tasks.show')->with('task',$task);
        return redirect('/home');
    }


    public function edit($id)
    {
        return redirect('/home');
    }

    public function update(Request $request, $taskId)
    {
        $task = Task::find($taskId);
        $this->authorize('completeOrUpdateTask', $task);

        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required',
            'assignedTo'=>'required',
        ]);

        if ($validator->passes()) {
            //update Task 
            $task->title = $request->title;
            $task->description = $request->description;
            $task->user_id = $request->assignedTo;
            //$task->due_date = now();
            $task->is_completed = $request->isCompleted;
            $task->save();

            return response()->json(['message'=>'updated']);
        }
        else if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }


    public function destroy($id)
    {
        $task = Task::find($id);
        $this->authorize('deleteTask', $task);
        $task->delete();
        return response()->json(['message'=>'done']);
    }
}
