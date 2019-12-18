<script type="text/javascript">

    document.onload = createTask();
    document.onload = setSprintId();

    function setSprintId()
    {
        //console.log('setSprintId');
        $(".add-task-modal").off('click').click(function(e){
            //console.log("setSprintId called");
            document.getElementById("sprint-id-text-field").value = $(this).attr('href');
        });
    }

    function createTask()
    {
        console.log('newTask');

        $( "#datepicker" ).datepicker({
                format: 'yyyy-mm-dd'
            });

        $(".new-task-submit").off('click').click(function(e){
            e.preventDefault();

            //console.log('newTask called');
            var sprintId = $("input[name=sprintId]").val();
            var taskId = $("input[name=taskId]").val();
            var assignedTo = $("select[name=assignedTo]").val();
            var title = $("input[name=title]").val();
            var description = $("textarea[name=description]").val();
            var dueDate = $("input[name=dueDate]").val();
;
            if(title.length>180){
                    alert("Error : Title field entry too long.");
            }

            $.ajax({
            type:'POST',
            url:'/tasks/create',
            data:{sprintId:sprintId, assignedTo:assignedTo, dueDate:dueDate, title:title, description:description},
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
                    
                    if(data.error){
                        alert(data.error);
                    }
                    

                    $("input[name=title]").val('');
                    $("textarea[name=description]").val('');
                    $("select[name=assignedTo]").val('');
            } 
            });
        });
    }


</script>