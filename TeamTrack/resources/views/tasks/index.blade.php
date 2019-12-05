@extends('layouts.app')

@section('content')

    <h2>My tasks</h2>

    @foreach($teams as $team)

            <hr><br><br>

            <h4>{{$team->name}}</h4>

            <div class="sprint-view rowview">

                <!-- Add Exception for new user without team -->
                @foreach($team->backlog->sprints as $sprint)

                    @if(count( $sprint->tasks->where('user_id', Auth::id()) ) > 0)

                        <div class="well cardview card m-2 p-3">
                            <div class="sprint{{$sprint->id}}">

                            <!-- Sprint -->
                            <h5>Sprint {{$sprint->sprint_no}}</h5>

                            <hr>
                            Tasks ({{count($sprint->tasks->where('user_id', Auth::id()))}}) :

                                @foreach($sprint->tasks->where('user_id', Auth::id()) as $task)
                                    <div class="card m-2 p-3">
                                    
                                        <!-- Task -->
                                        <div id="task{{$task->id}}">
                                            @if($task->is_completed)   
                                                <input type="checkbox" class="checkbox toggleIsCompleted" taskId="{{$task->id}}" checked>
                                            @else
                                                <input type="checkbox" class="checkbox toggleIsCompleted" taskId="{{$task->id}}">
                                            @endif
                                            <h5 id="taskTitle"> {{$task->title}} </h5> 
                                            <!-- ({{$task->id}}) -->
                                            <h6 id="taskDescription"> {{$task->description}} </h6>

                                            <h6 id="taskSprintId" hidden>{{$sprint->id}}</h6>
                                            <h6 id="taskAssignedToId" hidden>{{$task->user_id}}</h6>
                                            <h6 id="taskIsCompleted" hidden>{{$task->is_completed}}</h6>
                                        
                                            <hr>
                                                <div id="task{{$task->id}}AssignedTo" hidden>{{App\User::find($task->user_id)->id}}</div>
                                                Assigned to : {{App\User::find($task->user_id)->name}} <br>
                                                Created by : {{App\User::find($task->created_by)->name}}
                                            <br><br>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                                
                        </div>
                    @endif
                @endforeach 
            </div>

    @endforeach

@endsection