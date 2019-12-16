<script type="text/javascript">

    document.onload = toggleIsCompleted();

    function toggleIsCompleted()
          {
               $(".toggleIsCompleted").off('click').click(function(e){
                    e.preventDefault();
                    console.log('toggleIsCompleted called');

                    taskId = $(this).attr('taskId');
                    isCompleted = e.target.parentElement.parentElement.querySelector('#taskIsCompleted').innerHTML;
                    sprintId = e.target.parentElement.parentElement.querySelector('#taskSprintId').innerHTML;
                    assignedTo = e.target.parentElement.parentElement.querySelector('#taskAssignedToId').innerHTML;
                    title = e.target.parentElement.parentElement.querySelector('#taskTitleText').innerHTML;
                    description = e.target.parentElement.parentElement.querySelector('#taskDescription').innerHTML;
                    dueDate = e.target.parentElement.parentElement.querySelector('#taskDueDate').innerHTML;
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