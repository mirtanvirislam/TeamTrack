<script type="text/javascript">

    document.onload = deleteTask();

    function deleteTask()
    {
        //console.log('deleteTask');
        $(".delete-task").off('click').click(function(e){
            $taskId = $(this).attr('taskId');
            console.log("Delete task called : ".concat($taskId));
            //console.log("Delete task sprint: ".concat($(this).attr('sprint')));
            sprintId = $(this).attr('sprint');

            $.ajax({
            type:'DELETE',
            url: '/tasks/'.concat( $taskId ),
            success:function(data){
                    $('.sprint-view').load( window.location.pathname.concat(' .sprint-view'),
                        function(responseText, textStatus, XMLHttpRequest){
                            setSprintId();
                            setEditTaskModalInfo();
                            deleteTask();
                            deleteSprint();
                            toggleIsCompleted()
                    });
                    console.log(data.message);  
            } 
            });
        });
    }

</script>