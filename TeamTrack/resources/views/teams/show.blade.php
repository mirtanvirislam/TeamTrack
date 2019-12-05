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

            <div class="sprint-view rowview">

                {{count($team->backlog->sprints)}} Sprints
                <hr>

                <!-- Add Exception for new user without team -->
                @foreach($team->backlog->sprints as $sprint)
                    <div class="well cardview card m-2 p-3">
                        <div class="sprint{{$sprint->id}}">

                        <!-- Sprint -->
                        <h3>Sprint {{$sprint->sprint_no}}

                        <a href="{{$sprint->id}}"  class="add-task-modal float-right" data-toggle="modal" data-target="#newTaskModal">
                            <button class="btn btn-primary">Add Task</button>
                        </a>

                        </h3>

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
                                        <h5 id="taskTitle">
                                            @if($task->is_completed)   
                                                <input type="checkbox" class="checkbox toggleIsCompleted" taskId="{{$task->id}}" checked>
                                            @else
                                                <input type="checkbox" class="checkbox toggleIsCompleted" taskId="{{$task->id}}">
                                            @endif
                                                {{$task->title}} 

                                            
                                                @can('updateTask', $task)

                                                    <button 
                                                        class="delete-task btn btn-danger float-right ml-1"
                                                        taskId="{{$task->id}}"
                                                        sprint="{{$sprint->id}}">
                                                            Delete
                                                    </button>

                                                    <button 
                                                        class="edit-task-modal btn btn-primary float-right" 
                                                        taskId="{{$task->id}}" 
                                                        sprint="{{$sprint->id}}" 
                                                        data-toggle="modal" 
                                                        data-target="#editTaskModal">
                                                            Edit
                                                    </button>
                                                    
                                                    
                                                @endcan                                            
                                         

                                        </h5> 
                                        <h6 id="taskDescription"> {{$task->description}} </h6>

                                        <h6 id="taskSprintId" hidden>{{$sprint->id}}</h6>
                                        <h6 id="taskAssignedToId" hidden>{{$task->user_id}}</h6>
                                        <h6 id="taskIsCompleted" hidden>{{$task->is_completed}}</h6>
                                        <h6 id="taskDueDate" hidden>{{$task->due_date}}</h6>
                                    
                                        <hr>
                                            <div id="task{{$task->id}}AssignedTo" hidden>{{App\User::find($task->user_id)->id}}</div>

                                            @if($task->due_date > "2020-10-10")
                                                Greater than 2020.
                                            @endif
                                    
                                            Due date : {{$task->due_date}} <br>
                                            Assigned to : {{App\User::find($task->user_id)->name}} <br>
                                            Created by : {{App\User::find($task->created_by)->name}}
                                        <br><br>

                                        
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

@endsection