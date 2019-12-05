<script type="text/javascript">

    document.onload = setSprintId();

    function setSprintId()
        {
            //console.log('setSprintId');
            $(".add-task-modal").off('click').click(function(e){
                console.log("setSprintId called");
                document.getElementById("sprint-id-text-field").value = $(this).attr('href');
            });
        }


</script>