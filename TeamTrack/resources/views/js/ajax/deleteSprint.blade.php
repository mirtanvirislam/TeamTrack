<script type="text/javascript">

    document.onload = deleteSprint();

    function deleteSprint()
    {
        //console.log('deleteSprint called');

        $(".delete-sprint").off('click').click(function(e){
            console.log("deleteSprint called");
            var sprintId = $(this).attr('sprintId');

            $.ajax({
            type:'DELETE',
            url:'/sprints/'.concat(sprintId),
            data:{},
            success:function(data){
                console.log(data.message);
                $('.sprint-view').load( window.location.pathname.concat(' .sprint-view'),
                    function(responseText, textStatus, XMLHttpRequest){
                        setSprintId();
                        setEditTaskModalInfo();
                        reassignTask();
                        setRescheduleTaskModalInfo();
                        rescheduleTask();
                        deleteTask();
                        deleteSprint();
                        loadChart();
                        toggleIsCompleted();
                });
            } 
            });
        });
    }

</script>