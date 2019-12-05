<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    {!! Form::open(['action' =>  ['TasksController@update', ''], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('sprintId2', 'Sprint Id',[ 'hidden'])}}
                        {{Form::text('sprintId2', null, [ 'class' => 'form-control hidden', 'id'=>'sprint-id-text-field2','placeholder' => 'Sprint Id', 'hidden'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('isCompleted', 'isCompleted',[ 'hidden'])}}
                        {{Form::text('isCompleted', null, [ 'class' => 'form-control hidden', 'id'=>'isCompleted-field','placeholder' => 'isCompleted', 'hidden'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('taskId2', 'Task Id',[ 'hidden'])}}
                        {{Form::text('taskId2', null, [ 'class' => 'form-control hidden', 'id'=>'task-id-text-field','placeholder' => 'Task Id', 'hidden'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('title2', 'Task Title')}}
                        {{Form::text('title2', '' , ['class' => 'form-control', 'id'=>'title-text-field','placeholder' => 'Task Name', 'maxlength' => 180])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('assignedTo2', 'Assign Task to')}}
                        {{Form::select('assignedTo2', array($members), null, ['class' => 'form-control', 'id'=>'assigned-to-field', "placeholder" => "Pick member"])}}
                    </div>
                     <div class="form-group">
                        {{Form::label('dueDate2', 'Due Date')}}
                        {{Form::text('dueDate2', null , ['id' => 'datepicker2' , 'class' => 'form-control', 'placeholder' => 'Select due date'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('description2', 'Task Description')}}
                        {{Form::textarea('description2', '', ['class' => 'form-control', 'id'=>'description-text-field', 'placeholder' => 'Task Description'])}}
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::submit('Save', ['class'=>'btn btn-primary edit-task-submit', 'data-dismiss'=>'modal'])}}
                </div>
                
            </div>
        </div>
    {!! Form::close() !!}
</div>

 <script type="text/javascript">
    $(function() {
        $( "#datepicker2" ).datepicker({
            format: 'yyyy-mm-dd'
        });
    });
  </script>