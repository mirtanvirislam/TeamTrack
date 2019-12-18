<script type="text/javascript">

    document.onload = addMember();

    function addMember()
    {
        //console.log('addMember');
        $(".new-member-submit").off('click').click(function(e){
            e.preventDefault();

            console.log("addMember called");
            var email = $("input[name=email]").val();
            //console.log(email);

            $.ajax({
            type:'POST',
            url:'/members',
            data:{email:email},
            success:function(data){
                    console.log(data.message);
                    $('.content').load( window.location.pathname.concat(' .content'),
                        function(responseText, textStatus, XMLHttpRequest){
                            removeMember();
                    });

                    if(data.error.length>0){
                        alert(data.error);
                    }
            } 
            });

            $("input[name=email]").val('');
        });
    }

</script>