<!-- New Task Modal -->
<div class="modal fade" id="newTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    {!! Form::open(['action' => 'TasksController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('sprintId', 'Sprint Id',[ 'hidden'])}}
                        {{Form::text('sprintId', null, ['class' => 'form-control hidden', 'id'=>'sprint-id-text-field','placeholder' => 'Sprint Id', 'hidden'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('title', 'Task Title')}}
                        {{Form::text('title', '' , ['class' => 'form-control', 'placeholder' => 'Enter Task Title', 'maxlength' => 180, 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('assignedTo', 'Assign Task to')}}
                        {{Form::select('assignedTo', array($members), null, ['class' => 'form-control', "placeholder" => "Pick member" , 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('dueDate', 'Due Date')}}
                        {{Form::text('dueDate', '' , ['id' => 'datepicker' , 'class' => 'form-control', 'placeholder' => 'Select due date'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('description', 'Task Description')}}
                        {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Enter Task Description' ,  'required'])}}
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::submit('Add Task', ['class'=>'btn btn-primary new-task-submit', 'data-dismiss'=>'modal'])}}
                </div>
                
            </div>
        </div>
    {!! Form::close() !!}
</div>

 <script type="text/javascript">
    $(function() {
        $( "#datepicker" ).datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});
    });
  </script>