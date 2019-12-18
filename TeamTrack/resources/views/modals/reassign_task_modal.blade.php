<!-- Reassign Task Modal -->
<div class="modal fade" id="reassignTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    {!! Form::open(['action' =>  ['TasksController@update', ''], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Re-assign Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('sprintId3', 'Sprint Id',[ 'hidden'])}}
                        {{Form::text('sprintId3', null, [ 'class' => 'form-control hidden', 'id'=>'sprint-id-text-field3','placeholder' => 'Sprint Id', 'hidden'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('isCompleted3', 'isCompleted',[ 'hidden'])}}
                        {{Form::text('isCompleted3', null, [ 'class' => 'form-control hidden', 'id'=>'isCompleted-field3','placeholder' => 'isCompleted', 'hidden'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('taskId3', 'Task Id',[ 'hidden'])}}
                        {{Form::text('taskId3', null, [ 'class' => 'form-control hidden', 'id'=>'task-id-text-field3','placeholder' => 'Task Id', 'hidden'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('title3', 'Task Title')}}
                        {{Form::text('title3', '' , ['class' => 'form-control', 'id'=>'title-text-field3','placeholder' => 'Task Name', 'maxlength' => 180, 'disabled'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('assignedTo3', 'Assign Task to')}}
                        {{Form::select('assignedTo3', array($members), null, ['class' => 'form-control', 'id'=>'assigned-to-field3', "placeholder" => "Pick member"])}}
                    </div>
                     <div class="form-group">
                        {{-- {{Form::label('dueDate3', 'Due Date')}} --}}
                        {{Form::text('dueDate3', null , ['id' => 'datepicker3' , 'class' => 'form-control', 'placeholder' => 'Select due date', 'hidden'])}}
                    </div>
                    <div class="form-group">
                        {{-- {{Form::label('description3', 'Task Description')}} --}}
                        {{Form::textarea('description3', '', ['class' => 'form-control', 'id'=>'description-text-field3', 'placeholder' => 'Task Description', 'hidden'])}}
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::submit('Save', ['class'=>'btn btn-primary reassign-task-submit', 'data-dismiss'=>'modal'])}}
                </div>
                
            </div>
        </div>
    {!! Form::close() !!}
</div>