@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>

    <div id="container">

        <h1 id="pageTitle">{{$team->name}} Dashboard</h1>

        <div>

            @can('destroyTeam', $team)
                <br><br>
                {!! Form::open(['action' => ['TeamsController@destroy', $team->id], 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) !!}
                    {{Form::submit('Delete Team', ['class'=>'btn btn-danger'])}}
                {!! Form::close() !!}
                <br><br>
            @endcan

            

            <div class="sprint-view rowview">

                <script type="text/javascript">
                    console.log("yesss");
                </script>
                                  
                <div id='stat'>
                    <button class="btn  btn-secondary btn-pill float-left mr-4" disabled>
                        <b> Total task : {{$total_task_count}} </b>
                    </button>
                    <button class="btn  btn-primary btn-pill float-left mr-4" disabled>
                        <b> Completed task : {{$completed_task_count}} </b>
                    </button>
                    <button class="btn  btn-secondary btn-pill float-left mr-4" disabled>
                        <b> Remaining task : {{ $total_task_count - $completed_task_count }} </b>
                    </button>
                    <button class="btn  btn-danger btn-pill float-left mr-4" disabled>
                        <b> Overdue task : </b>
                    </button>
                    
                    <div id="completed_task_array" hidden>{{ implode('', $completed_task_array) }}</div>
                    <div id="overdue_task_array" hidden>{{ implode('', $overdue_task_array) }}</div>
                    <div id="scheduled_task_array" hidden>{{ implode('', $scheduled_task_array) }}</div>
                </div>
                <br>
                
                <div class="d-flex w-100 bd-highlight">
                    <div class="p-2 flex-fill w-100 bd-highlight">
                         <canvas id="canvas" width="600" height="200"></canvas>
                    </div>
                    <div class="p-2 flex-fill bd-highlight">
                        @foreach($team->users as $user)
                            <!-- Each Member --> <hr>
                            <h6> {{$user->name}} </h6>

                             @if(count(App\Task::where('user_id',$user->id)->get()) > 0)
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" 
                                        style="width: {{ (count(App\Task::where('user_id',$user->id)->where('is_completed',1)->get())/count(App\Task::where('user_id',$user->id)->get()) )*100 }}%" 
                                        ></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

               

                


                {{count($team->backlog->sprints)}} Sprints <br><br>
                <div hidden> {{date_default_timezone_set('Asia/Dhaka') }} </div>
                       
                <!-- Add Exception for new user without team -->
                @foreach($team->backlog->sprints as $sprint)
                    <div class="well cardview card m-2 p-3">
                        <div class="sprint{{$sprint->id}}">

                        <!-- Sprint -->
                        <h3>Sprint {{$sprint->sprint_no}}

                        <a href="{{$sprint->id}}"  class="add-task-modal float-right" data-toggle="modal" data-target="#newTaskModal">
                            <button class="btn btn-primary"> 
                            <i class="material-icons">
                            add
                            </i>
                             Add Task</button>
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
                                <div class="card m-2 pb-1 pt-3 pl-3 pr-3">
                                
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
                                                    <i class="material-icons">
                                                        delete_forever
                                                    </i>
                                                        Delete
                                                </button>

                                                <button 
                                                    class="edit-task-modal btn btn-primary float-right" 
                                                    taskId="{{$task->id}}" 
                                                    sprint="{{$sprint->id}}" 
                                                    data-toggle="modal" 
                                                    data-target="#editTaskModal">
                                                    <i class="fa fa-edit"></i>
                                                        Edit
                                                </button>

                                            @endcan
                                                
                                            <i class="btn float-right material-icons align-middle" data-toggle="collapse" data-target="#t{{$task->id}}" aria-expanded="false" aria-controls="collapseExample">
                                                info
                                            </i>

                                            <button
                                                class="btn btn-outline-secondary btn-pill float-right mr-4" disabled>
                                                {{$task->due_date}}
                                            </button>

                                            <button
                                                class="btn btn-outline-primary btn-pill float-right mr-2" disabled>
                                                {{App\User::find($task->user_id)->name}}
                                            </button>
                                                
                                            @if( ($task->due_date < date('Y-m-d')) && $task->is_completed==0 )
                                                <button class="btn btn-danger btn-pill float-right mr-4" disabled>
                                                    Overdue : {{ date_diff( date_create($task->due_date) , date_create(date('Y-m-d')))->format('%a days') }}
                                                </button>
                                            @endif                                               
                                         
                                        </h5> 

                                        <h6 id="taskDescription" hidden> {{$task->description}} </h6>
                                        <h6 id="taskSprintId" hidden>{{$sprint->id}}</h6>
                                        <h6 id="taskTitleText" hidden>{{$task->title}}</h6>
                                        <h6 id="taskAssignedToId" hidden>{{$task->user_id}}</h6>
                                        <h6 id="taskIsCompleted" hidden>{{$task->is_completed}}</h6>
                                        <h6 id="taskDueDate" hidden>{{$task->due_date}}</h6>
                                        <div id="task{{$task->id}}AssignedTo" hidden>{{App\User::find($task->user_id)->id}}</div>
                                                                     
                                        <div class="collapse" id="t{{$task->id}}">
                                            <h6>{{$task->description}}</h6>
                                            Created by : {{App\User::find($task->created_by)->name}} <br>
                                            Created at : {{$task->created_at}}
                                        </div>
                                                                           
                                    </div>
                                </div>
                            @endforeach
                        </div>
                            
                    </div>
                @endforeach 
            </div>

            <br>

            <a class="new-sprint-submit m-2">
                <button class="btn btn-primary">Add Sprint</button>
            </a> 

        </div>
    </div>

    
    @include('modals.new_task_modal')
    @include('modals.edit_task_modal')

<script type="text/javascript">

    console.log('load1');
  
    var sprints = {{ count($team->backlog->sprints) }} ;
    var barChartData = {};

    function reloadChartData(){
        console.log('reload Chart data');

        barChartData = {
        labels: [{{ implode(',', $sprints) }}],
        datasets: [{
            label: 'Completed Tasks',
            backgroundColor: window.chartColors.blue,
            data: document.getElementById('completed_task_array').innerHTML
        }, {
            label: 'Overdue Tasks',
            backgroundColor: window.chartColors.red,
            data: document.getElementById('overdue_task_array').innerHTML
        },{
            label: 'Scheduled Tasks',
            backgroundColor: window.chartColors.grey,
            data: document.getElementById('scheduled_task_array').innerHTML
        }]
    };
    }
    
    window.onload = loadChart();
    

    function loadChart() {

        reloadChartData();
        console.log('reload Chart');
        console.log(barChartData);

        var ctx = document.getElementById('canvas').getContext('2d');
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                title: {
                    display: true,
                    
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                responsive: true,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }
        });
    };
</script>


@endsection