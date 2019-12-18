<!-- Reassign Task Modal -->
<div class="modal fade" id="rescheduleTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    {!! Form::open(['action' =>  ['TasksController@update', ''], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Re-schedule Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('sprintId4', 'Sprint Id',[ 'hidden'])}}
                        {{Form::text('sprintId4', null, [ 'class' => 'form-control hidden', 'id'=>'sprint-id-text-field4','placeholder' => 'Sprint Id', 'hidden'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('isCompleted4', 'isCompleted',[ 'hidden'])}}
                        {{Form::text('isCompleted4', null, [ 'class' => 'form-control hidden', 'id'=>'isCompleted-field4','placeholder' => 'isCompleted', 'hidden'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('taskId4', 'Task Id',[ 'hidden'])}}
                        {{Form::text('taskId4', null, [ 'class' => 'form-control hidden', 'id'=>'task-id-text-field4','placeholder' => 'Task Id', 'hidden'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('title4', 'Task Title')}}
                        {{Form::text('title4', '' , ['class' => 'form-control', 'id'=>'title-text-field4','placeholder' => 'Task Name', 'maxlength' => 180, 'disabled'])}}
                    </div>
                    <div class="form-group">
                        {{-- {{Form::label('assignedTo4', 'Assign Task to')}} --}}
                        {{Form::select('assignedTo4', array($members), null, ['class' => 'form-control', 'id'=>'assigned-to-field4', "placeholder" => "Pick member", 'hidden'])}}
                    </div>
                     <div class="form-group">
                        {{Form::label('dueDate4', 'Due Date')}}
                        {{Form::text('dueDate4', null , ['id' => 'datepicker4' , 'class' => 'form-control', 'placeholder' => 'Select due date'])}}
                    </div>
                    <div class="form-group">
                        {{-- {{Form::label('description4', 'Task Description')}} --}}
                        {{Form::textarea('description4', '', ['class' => 'form-control', 'id'=>'description-text-field4', 'placeholder' => 'Task Description', 'hidden'])}}
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::submit('Save', ['class'=>'btn btn-primary reschedule-task-submit', 'data-dismiss'=>'modal'])}}
                </div>
                
            </div>
        </div>
    {!! Form::close() !!}
</div>

 <script type="text/javascript">
    $(function() {
        $( "#datepicker4" ).datepicker({
            format: 'yyyy-mm-dd'
        });
    });
  </script>