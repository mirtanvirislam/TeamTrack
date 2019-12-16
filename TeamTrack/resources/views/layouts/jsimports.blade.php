<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
<script src="{{ asset('template/scripts/extras.1.1.0.min.js') }}"></script>
<script src="{{ asset('template/scripts/shards-dashboards.1.1.0.min.js') }}"></script>
<script src="{{ asset('template/scripts/app/app-blog-overview.1.1.0.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>

{{-- 
<script type="text/javascript">

          $.ajaxSetup({
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
          });

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


          function setSidebar()
          {
               
               $(".sidebar-link").off('click').click(function(e){
                    console.log('setSidebar called');
                    e.preventDefault();
                    // Load the content from the link's href attribute
                    $('.content').load( $(this).attr('href').concat(' .content'), function(responseText, textStatus, XMLHttpRequest){
                         initializeFunctions();
                         });
                    //Change window location
                    //window.location.replace($(this).attr('href'));
                    window.history.pushState('', 'Title', $(this).attr('href'));
               });
          }
          



          function setSprintId()
          {
               //console.log('setSprintId');
               $(".add-task-modal").off('click').click(function(e){
                    console.log("setSprintId called");
                    document.getElementById("sprint-id-text-field").value = $(this).attr('href');
               });
          }



          function setEditTaskModalInfo()
          {
               $(".edit-task-modal").off('click').click(function(e){

                    taskId = $(this).attr('taskId');
                    isCompleted = e.target.parentElement.parentElement.querySelector('#taskIsCompleted').innerHTML;
                    sprintId = e.target.parentElement.parentElement.querySelector('#taskSprintId').innerHTML;
                    assignedTo = e.target.parentElement.parentElement.querySelector('#taskAssignedToId').innerHTML;
                    title = e.target.parentElement.parentElement.querySelector('#taskTitle').innerHTML;
                    description = e.target.parentElement.parentElement.querySelector('#taskDescription').innerHTML;
                    console.log('setEditTaskModalInfo called. task: '.concat(taskId));

                     document.getElementById("sprint-id-text-field2").value = sprintId;
                     document.getElementById("isCompleted-field").value = isCompleted;
                     document.getElementById("task-id-text-field").value = taskId;
                     document.getElementById("assigned-to-field").value = assignedTo;
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

                    if(title.length>180){
                         alert("Error : Title field entry too long.");
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

          function newTask()
          {
               //console.log('newTask');
               $(".new-task-submit").off('click').click(function(e){
                    e.preventDefault();

                    console.log('newTask called');
                    var sprintId = $("input[name=sprintId]").val();
                    var taskId = $("input[name=taskId]").val();
                    var assignedTo = $("select[name=assignedTo]").val();
                    var title = $("input[name=title]").val();
                    var description = $("textarea[name=description]").val();
;
                    if(title.length>180){
                         alert("Error : Title field entry too long.");
                    }

                    $.ajax({
                    type:'POST',
                    url:'/tasks/create',
                    data:{sprintId:sprintId, assignedTo:assignedTo, title:title, description:description},
                    success:function(data){
                          $('.sprint-view').load( window.location.pathname.concat(' .sprint-view'),
                              function(responseText, textStatus, XMLHttpRequest){
                                   setSprintId();
                                   setEditTaskModalInfo();
                                   deleteTask();
                                   deleteSprint();
                                   setCommentTaskModalInfo();
                                   newComment();
                                   toggleIsCompleted();
                                   console.log(data.message);
                         });
                         
                         if(data.error.length>0){
                              alert(data.error);
                         }
                         

                         $("input[name=title]").val('');
                         $("textarea[name=description]").val('');
                         $("select[name=assignedTo]").val('');
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
                                   setCommentTaskModalInfo();
                                   newComment();
                                   toggleIsCompleted()
                         });

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