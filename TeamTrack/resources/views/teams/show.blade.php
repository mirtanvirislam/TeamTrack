@extends('layouts.app')

@section('content')



    <div id="container">

        <h1 id="pageTitle">{{$team->name}} Dashboard</h1>

        <hr>

        <div>

            <a class="new-sprint-submit">
                <button class="btn btn-primary">Add Sprint</button>
            </a> 
            
            @can('destroyTeam', $team)
                <br><br>
                {!! Form::open(['action' => ['TeamsController@destroy', $team->id], 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) !!}
                    {{Form::submit('Delete Team', ['class'=>'btn btn-danger'])}}
                {!! Form::close() !!}
            @endcan

            <br><br>
{{-- 
            @foreach($tasks as $sprint)
                 <h6>{{$sprint}}</h6>
                @foreach($sprint as $task)
                    <small>{{$task}}</small>
                @endforeach
            @endforeach
             --}}

            <div class="sprint-view rowview">

                {{count($team->backlog->sprints)}} Sprints
                <hr>

                <!-- Add Exception for new user without team -->
                @foreach($team->backlog->sprints as $sprint)
                    <div class="well cardview card m-2 p-3">
                        <div class="sprint{{$sprint->id}}">

                        <!-- Sprint -->
                        <h3>Sprint {{$sprint->sprint_no}}</h3>

                        <a href="{{$sprint->id}}"  class="add-task-modal" data-toggle="modal" data-target="#newTaskModal">
                            <button class="btn btn-primary">Add Task</button>
                        </a>

                        @can('deleteSprint', $sprint)
                            <button 
                                class="delete-sprint btn btn-danger"
                                sprintId="{{$sprint->id}}"
                            >
                                Delete Sprint 
                            </button>
                        @endcan

                        <hr>
                        Tasks ({{count($sprint->tasks)}}) :
                            @foreach($sprint->tasks as $task)
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

                                        <div>
                                            @can('updateTask', $task)
                                                <button 
                                                    class="edit-task-modal btn btn-primary " 
                                                    taskId="{{$task->id}}" 
                                                    sprint="{{$sprint->id}}" 
                                                    data-toggle="modal" 
                                                    data-target="#editTaskModal">
                                                        Edit
                                                </button>
                                                
                                                <button 
                                                    class="delete-task btn btn-danger"
                                                    taskId="{{$task->id}}"
                                                    sprint="{{$sprint->id}}">
                                                        Delete
                                                </button>
                                            @endcan
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                            
                    </div>
                @endforeach 
            </div>
        </div>
    </div>

    
    @include('modals.new_task_modal')
    @include('modals.edit_task_modal')
    @include('modals.comment_task_modal')

@endsection