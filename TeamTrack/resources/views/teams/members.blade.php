@extends('layouts.app')

@section('content')

    <div id="container">

        <h1 id="pageTitle">{{$team->name}} Members</h1>

        <hr>

        <div class="well card m-3 p-3">
            <div class="team-leader">
                <h4>Team leader</h4> <hr>
                 {{ App\User::find($team->leader_id)->name }}
            </div>
        </div>

        <div class="well card m-3 p-3">
            <div class="team-member">
                <h4>Team members </h4> <hr>

                <!-- Member list -->
                    @foreach($team->users as $user)
                        @if($user->id != $team->leader_id) <!-- check if member is leader -->
                        <!-- Each Member -->
                            {{$user->name}}
                                <!-- Don't display remove btn if user is leader -->
                                @can('removeMember', $team)
                                    <button 
                                        class="remove-member btn btn-outline-danger mb-2"
                                        userId="{{$user->id}}">
                                            Remove 
                                    </button>
                                @endcan
                            <br>
                        @endif
                    @endforeach
            </div>
        </div>

        <div class="well card m-3 p-3">
            <div class="sprint-view  team-member">
                <h4>Team members tasks</h4>

                <!-- Member list -->
                    @foreach($team->users as $user)
                        <!-- Each Member --> <hr>
                        <h5> {{$user->name}} </h5>

                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" 
                                style="width: {{ (count(App\Task::where('user_id',$user->id)->where('is_completed',1)->get())/count(App\Task::where('user_id',$user->id)->get()) )*100 }}%" 
                                ></div>
                        </div>

                        Total task : {{ $total_task = count(App\Task::where('user_id',$user->id)->get())}} <br>
                        Completed task : {{ $completed_task = count(App\Task::where('user_id',$user->id)->where('is_completed',1)->get())}} <br>
                        Incomplete task : {{ $total_task-$completed_task }}
                            <!-- Member tasks -->

                            @foreach($team->backlog->sprints as $sprint)
                                @foreach($sprint->tasks->where('user_id',$user->id) as $task)
                                    
                                    <!-- Task -->
                                    <div class="card m-2 pb-1 pt-3 pl-3 pr-3">
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
                                                        class="reassign-task-modal btn btn-primary float-right mr-2"
                                                        taskId="{{$task->id}}" 
                                                        sprint="{{$task->sprint_id}}" 
                                                        data-toggle="modal" 
                                                        data-target="#reassignTaskModal">
                                                        Re-assign
                                                    </button>

                                                    <button
                                                        class="reschedule-task-modal btn btn-primary float-right mr-2"
                                                        taskId="{{$task->id}}" 
                                                        sprint="{{$task->sprint_id}}" 
                                                        data-toggle="modal" 
                                                        data-target="#rescheduleTaskModal">
                                                        Re-schedule
                                                    </button>
                                                @endcan
                                                    
                                                <i class="btn float-right material-icons align-middle" data-toggle="collapse" data-target="#t{{$task->id}}" aria-expanded="false" aria-controls="collapseExample">
                                                    info
                                                </i>

                                                <button
                                                    class="btn btn-outline-secondary btn-pill float-right mr-4" disabled>
                                                    {{$task->due_date}}
                                                </button>

                                                @if( ($task->due_date < date('Y-m-d')) && $task->is_completed==0 )
                                                    <button class="btn btn-danger btn-pill float-right mr-4" disabled>
                                                        Overdue : {{ date_diff( date_create($task->due_date) , date_create(date('Y-m-d')))->format('%a days') }}
                                                    </button>
                                                @elseif( $task->is_completed==0 )
                                                    <button class="btn btn-secondary btn-pill float-right mr-4" disabled>
                                                        Due : {{ date_diff( date_create($task->due_date) , date_create(date('Y-m-d')))->format('%a days') }}
                                                    </button>
                                                @endif                                               
                                            
                                            </h5> 

                                            <h6 id="taskDescription" hidden> {{$task->description}} </h6>
                                            <h6 id="taskSprintId" hidden>{{$task->sprint_id}}</h6>
                                            <h6 id="taskTitleText" hidden>{{$task->title}}</h6>
                                            <h6 id="taskAssignedToId" hidden>{{$task->user_id}}</h6>
                                            <h6 id="taskIsCompleted" hidden>{{$task->is_completed}}</h6>
                                            <h6 id="taskDueDate" hidden>{{$task->due_date}}</h6>
                                            <div id="task{{$task->id}}AssignedTo" hidden>{{App\User::find($task->user_id)->id}}</div>
                                                                        
                                            <div class="collapse" id="t{{$task->id}}">
                                                <h6>{{$task->description}}</h6>
                                                Created by : {{App\User::find($task->created_by)->name}}
                                            </div>
                                                                            
                                        </div>
                                    </div>

                                @endforeach
                            @endforeach
                        <br>
                    @endforeach
            </div>
        </div>

        <br>

        @can('addMember', $team)
            <!-- Button trigger newMemberModal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newMemberModal">
                Add Member
            </button>
        @endcan

        @include('modals.new_member_modal')

    </div>

    @include('modals.edit_task_modal')
    @include('modals.reassign_task_modal')
    @include('modals.reschedule_task_modal')






@endsection