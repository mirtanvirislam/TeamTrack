@include('js.ajax.csrf')

@include('js.ajax.navigation')
@include('js.ajax.createSprint')
@include('js.ajax.setSprintId')
@include('js.ajax.createTask')
@include('js.ajax.editTask')

{{-- 
<script type="text/javascript">

        
          document.onload = initializeFunctions();

          function initializeFunctions()
          {
               setSidebar();
               newSprint();
               setSprintId();
               newTask();
               editTask();
               newMember();
               deleteTask();
               setEditTaskModalInfo();
               deleteSprint();
               removeMember();
               setCommentTaskModalInfo();
               newComment();
               toggleIsCompleted();
          }
          

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
                                   setCommentTaskModalInfo();
                                   newComment();
                                   toggleIsCompleted()
                         });
                         console.log(data.message);
                    } 
                    });
               });
          }

          
          function setCommentTaskModalInfo()
          {
               $(".comment-task-modal").off('click').click(function(e){

                    taskId = $(this).attr('taskId');
                    console.log('setCommentTaskModalInfo called. task: '.concat(taskId));

                     document.getElementById("task-id-text-field3").value = taskId;
               });
          }

          function newComment()
          {
               //console.log('newComment');
               $(".comment-task-submit").off('click').click(function(e){
                    e.preventDefault();

                    console.log('newComment called');
                    var taskId = $("input[name=taskId3]").val();
                    var commentContent = $("textarea[name=commentContent]").val();

                    $.ajax({
                    type:'POST',
                    url:'/comments',
                    data:{taskId:taskId, commentContent:commentContent},
                    success:function(data){
                          $('.sprint-view').load( window.location.pathname.concat(' .sprint-view'),
                              function(responseText, textStatus, XMLHttpRequest){
                                   setSprintId();
                                   setEditTaskModalInfo();
                                   deleteTask();
                                   deleteSprint();
                                   setCommentTaskModalInfo();
                                   newComment();
                                   toggleIsCompleted()
                         });
                         console.log(data.message);  
                         $("textarea[name=commentContent]").val('');
                    } 
                    });
               });
          }

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
                                   setCommentTaskModalInfo();
                                   newComment();
                                   toggleIsCompleted()
                         });
                         console.log(data.message);  
                    } 
                    });
               });
          }

          

          function newMember()
          {
               //console.log('newMember');
               $(".new-member-submit").off('click').click(function(e){
                    e.preventDefault();

                    console.log("newMember called");
                    var email = $("input[name=email]").val();
                    //console.log(email);

                    $.ajax({
                    type:'POST',
                    url:'/members',
                    data:{email:email},
                    success:function(data){
                         console.log(data.message);
                         $('.team-member').load( window.location.pathname.concat(' .team-member'),
                              function(responseText, textStatus, XMLHttpRequest){
                                   removeMember();
                         });

                         if(data.error.length>0){
                              alert(data.error);
                         }
                    } 
                    });
               });
          }
          

          function deleteSprint()
          {
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
                                   deleteTask();
                                   deleteSprint();
                                   setCommentTaskModalInfo();
                                   newComment();
                                   toggleIsCompleted()
                         });
                    } 
                    });
               });
          }


          function removeMember()
          {
               $(".remove-member").off('click').click(function(e){
                    console.log("removeMember called");
                    var id = $(this).attr('userId');

                    $.ajax({
                    type:'DELETE',
                    url:'/members/'.concat(id),
                    data:{},
                    success:function(data){
                         console.log(data.message);
                         $('.team-member').load( window.location.pathname.concat(' .team-member'),
                              function(responseText, textStatus, XMLHttpRequest){
                                   removeMember();
                         });
                    } 
                    });
               });
          }

     </script> --}}