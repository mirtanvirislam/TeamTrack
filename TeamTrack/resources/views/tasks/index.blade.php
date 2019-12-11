@extends('layouts.app')

@section('content')


    <h2>My tasks</h2>

	@foreach($teams as $team)
		
		<br>  <div hidden> {{date_default_timezone_set('Asia/Dhaka') }} </div>

		<div class="sprint-view rowview">

			<!-- Add Exception for new user without team -->
			@foreach($team->backlog->sprints as $sprint)

				@if(count( $sprint->tasks->where('user_id', Auth::id()) ) > 0)
		
					<div class="well cardview card m-2 pb-1 pt-3 pl-3 pr-3">
						<div class="sprint{{$sprint->id}}">

						<!-- Sprint -->
						
						<h5>
							{{$team->name}}  
							<small>
								( Tasks : {{count($sprint->tasks->where('user_id', Auth::id()))}} )
							</small>
						</h5>

							@foreach($sprint->tasks->where('user_id', Auth::id()) as $task)
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
																																
											<i class="btn float-right material-icons align-middle" data-toggle="collapse" data-target="#t{{$task->id}}" aria-expanded="false" aria-controls="collapseExample">
												info
											</i>

											<button
												class="btn btn-outline-secondary btn-pill float-right mr-4" disabled>
												{{$task->due_date}}
											</button>
									
											<button
												class="btn btn-outline-info btn-pill float-right mr-2" disabled>
												{{App\User::find($task->user_id)->name}}
											</button>   

											<button
												class="btn btn-outline-primary btn-pill float-right mr-2" disabled>
												Sprint {{$sprint->sprint_no}}
											</button>   

											@if( ($task->due_date < date('Y-m-d')) && $task->is_completed==0 )
												<button class="btn btn-danger btn-pill float-right mr-4" disabled>
													Overdue : {{ date_diff( date_create($task->due_date) , date_create(date('Y-m-d')))->format('%a days') }}
												</button>
											@else
												<button class="btn btn-secondary btn-pill float-right mr-4" disabled>
													Due : {{ date_diff( date_create($task->due_date) , date_create(date('Y-m-d')))->format('%a days') }}
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
											Created by : {{App\User::find($task->created_by)->name}}
										</div>
																		
									</div>

									{{-- <div id="task{{$task->id}}">
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

									</div> --}}
								</div>
							@endforeach
						</div>
							
					</div>
				@endif
			@endforeach 
		</div>

	@endforeach
	

@endsection