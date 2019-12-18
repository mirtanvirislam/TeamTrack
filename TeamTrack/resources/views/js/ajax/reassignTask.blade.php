<script type="text/javascript">

    document.onload = setReassignTaskModalInfo();
    document.onload = reassignTask();

    function setReassignTaskModalInfo()
    {

        $(function() {
            $( "#datepicker4" ).datepicker({
                format: 'yyyy-mm-dd'
            });
        });

        $(".reassign-task-modal").off('click').click(function(e){

            taskId = $(this).attr('taskId');
            isCompleted = e.target.parentElement.parentElement.querySelector('#taskIsCompleted').innerHTML;
            sprintId = e.target.parentElement.parentElement.querySelector('#taskSprintId').innerHTML;
            dueDate = e.target.parentElement.parentElement.querySelector('#taskDueDate').innerHTML;
            assignedTo = e.target.parentElement.parentElement.querySelector('#taskAssignedToId').innerHTML;
            title = e.target.parentElement.parentElement.querySelector('#taskTitleText').innerHTML;
            description = e.target.parentElement.parentElement.querySelector('#taskDescription').innerHTML;
            console.log('setReassignTaskModalInfo called. task: '.concat(taskId));

                document.getElementById("sprint-id-text-field3").value = sprintId;
                document.getElementById("isCompleted-field3").value = isCompleted;
                document.getElementById("task-id-text-field3").value = taskId;
                document.getElementById("assigned-to-field3").value = assignedTo;
                document.getElementById("datepicker3").value = dueDate;
                document.getElementById("title-text-field3").value = title;
                document.getElementById("description-text-field3").value = description;
                
        });
    }
    
    function reassignTask()
    {
        $( "#datepicker" ).datepicker({
                format: 'yyyy-mm-dd'
            });

        $(".reassign-task-submit").off('click').click(function(e){
            e.preventDefault();
            console.log('reassignTask called');

            var sprintId = $("input[name=sprintId3]").val();
            var isCompleted = $("input[name=isCompleted3]").val();
            var taskId = $("input[name=taskId3]").val();
            var assignedTo = $("select[name=assignedTo3]").val();
            var title = $("input[name=title3]").val();
            var description = $("textarea[name=description3]").val();
            var dueDate = $("input[name=dueDate3]").val();

            $.ajax({
            type:'PUT',
            url:'/tasks/'.concat(taskId),
            data:{sprintId:sprintId, isCompleted:isCompleted, assignedTo:assignedTo, dueDate:dueDate, title:title, description:description},
            success:function(data){
                    $('.sprint-view').load( window.location.pathname.concat(' .sprint-view'),
                        function(responseText, textStatus, XMLHttpRequest){
                            setSprintId();
                            setEditTaskModalInfo();
                            setReassignTaskModalInfo();
                            reassignTask();
                            setRescheduleTaskModalInfo();
                            rescheduleTask();
                            deleteTask();
                            deleteSprint();
                            toggleIsCompleted();
                            loadChart();
                            console.log(data.message);
                    });
                    
                    if(data.error.length>0){
                        alert(data.error);
                    }
            } 
            });
        });
    }

</script>