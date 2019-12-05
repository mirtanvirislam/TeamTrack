<script type="text/javascript">

    document.onload = setEditTaskModalInfo();
    document.onload = editTask();

    function setEditTaskModalInfo()
    {
        $(".edit-task-modal").off('click').click(function(e){

            taskId = $(this).attr('taskId');
            isCompleted = e.target.parentElement.parentElement.querySelector('#taskIsCompleted').innerHTML;
            sprintId = e.target.parentElement.parentElement.querySelector('#taskSprintId').innerHTML;
            dueDate = e.target.parentElement.parentElement.querySelector('#taskDueDate').innerHTML;
            assignedTo = e.target.parentElement.parentElement.querySelector('#taskAssignedToId').innerHTML;
            title = e.target.parentElement.parentElement.querySelector('#taskTitle').innerHTML;
            description = e.target.parentElement.parentElement.querySelector('#taskDescription').innerHTML;
            console.log('setEditTaskModalInfo called. task: '.concat(taskId));

                document.getElementById("sprint-id-text-field2").value = sprintId;
                document.getElementById("isCompleted-field").value = isCompleted;
                document.getElementById("task-id-text-field").value = taskId;
                document.getElementById("assigned-to-field").value = assignedTo;
                document.getElementById("datepicker2").value = dueDate;
                document.getElementById("title-text-field").value = title;
                document.getElementById("description-text-field").value = description;
                
        });
    }
    
    function editTask()
    {
        $(".edit-task-submit").off('click').click(function(e){
            e.preventDefault();
            console.log('editTask called');

            var sprintId = $("input[name=sprintId2]").val();
            var isCompleted = $("input[name=isCompleted]").val();
            var taskId = $("input[name=taskId2]").val();
            var assignedTo = $("select[name=assignedTo2]").val();
            var title = $("input[name=title2]").val();
            var description = $("textarea[name=description2]").val();
            var dueDate = $("input[name=dueDate2]").val();

            if(title.length>180){
                    alert("Error : Title field entry too long.");
            }

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