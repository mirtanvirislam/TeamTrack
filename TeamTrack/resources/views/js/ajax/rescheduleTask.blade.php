<script type="text/javascript">

    document.onload = setRescheduleTaskModalInfo();
    document.onload = rescheduleTask();

    function setRescheduleTaskModalInfo()
    {
        $(".reschedule-task-modal").off('click').click(function(e){

            taskId = $(this).attr('taskId');
            isCompleted = e.target.parentElement.parentElement.querySelector('#taskIsCompleted').innerHTML;
            sprintId = e.target.parentElement.parentElement.querySelector('#taskSprintId').innerHTML;
            dueDate = e.target.parentElement.parentElement.querySelector('#taskDueDate').innerHTML;
            assignedTo = e.target.parentElement.parentElement.querySelector('#taskAssignedToId').innerHTML;
            title = e.target.parentElement.parentElement.querySelector('#taskTitleText').innerHTML;
            description = e.target.parentElement.parentElement.querySelector('#taskDescription').innerHTML;
            console.log('setRescheduleTaskModalInfo called. task: '.concat(taskId));

                document.getElementById("sprint-id-text-field4").value = sprintId;
                document.getElementById("isCompleted-field4").value = isCompleted;
                document.getElementById("task-id-text-field4").value = taskId;
                document.getElementById("assigned-to-field4").value = assignedTo;
                document.getElementById("datepicker4").value = dueDate;
                document.getElementById("title-text-field4").value = title;
                document.getElementById("description-text-field4").value = description;
                
        });
    }
    
    function rescheduleTask()
    {
        $( "#datepicker" ).datepicker({
                format: 'yyyy-mm-dd'
            });

        $(".reschedule-task-submit").off('click').click(function(e){
            e.preventDefault();
            console.log('rescheduleTask called');

            var sprintId = $("input[name=sprintId4]").val();
            var isCompleted = $("input[name=isCompleted4]").val();
            var taskId = $("input[name=taskId4]").val();
            var assignedTo = $("select[name=assignedTo4]").val();
            var title = $("input[name=title4]").val();
            var description = $("textarea[name=description4]").val();
            var dueDate = $("input[name=dueDate4]").val();

            $.ajax({
            type:'PUT',
            url:'/tasks/'.concat(taskId),
            data:{sprintId:sprintId, isCompleted:isCompleted, assignedTo:assignedTo, dueDate:dueDate, title:title, description:description},
            success:function(data){
                    $('.sprint-view').load( window.location.pathname.concat(' .sprint-view'),
                        function(responseText, textStatus, XMLHttpRequest){
                            setSprintId();
                            setEditTaskModalInfo();
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