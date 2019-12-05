<script type="text/javascript">

    document.onload = toggleIsCompleted();

    function toggleIsCompleted()
          {
               $(".toggleIsCompleted").off('click').click(function(e){
                    e.preventDefault();
                    console.log('toggleIsCompleted called');

                    taskId = $(this).attr('taskId');
                    isCompleted = e.target.parentElement.querySelector('#taskIsCompleted').innerHTML;
                    sprintId = e.target.parentElement.querySelector('#taskSprintId').innerHTML;
                    assignedTo = e.target.parentElement.querySelector('#taskAssignedToId').innerHTML;
                    title = e.target.parentElement.querySelector('#taskTitle').innerHTML;
                    description = e.target.parentElement.querySelector('#taskDescription').innerHTML;
                    console.log('toggleIsCompleted called. task: '.concat(taskId));

                    //Toggle isCompleted state
                    if(isCompleted==0){
                         isCompleted=1;
                    }else{
                         isCompleted=0;
                    }

                    $.ajax({
                    type:'PUT',
                    url:'/tasks/'.concat(taskId),
                    data:{sprintId:sprintId, isCompleted:isCompleted, assignedTo:assignedTo, title:title, description:description},
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