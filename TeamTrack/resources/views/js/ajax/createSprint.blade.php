<script type="text/javascript">

    document.onload = newSprint();

    function newSprint()
        {
            //console.log('newSprint');
            $(".new-sprint-submit").off('click').click(function(e){
                e.preventDefault();

                console.log("newSprint called");

                $.ajax({
                type:'POST',
                url:'/sprints',
                success:function(data){
                        //console.log(data.message);
                        //location.reload();
                        $('.sprint-view').load( window.location.pathname.concat(' .sprint-view'),
                            function(responseText, textStatus, XMLHttpRequest){
                                setSprintId();
                                setEditTaskModalInfo();
                                deleteTask();
                                deleteSprint();
                                toggleIsCompleted()
                        });

                } 
                });
            });
        }

</script>