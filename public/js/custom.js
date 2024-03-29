$(document).ready(function() {     
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.action-follow').click(function(){    
        var user_id = $(this).attr('data-id');
        var cObj = $(this);
        var c = $(this).parent("div").find(".tl-follower").text();
        var url = '/ajaxRequest?user_id=' + user_id;
        $.ajax({
           type:'POST',
           url:url,
           data:{user_id:user_id},
           success:function(data){
              console.log(data.count);
              if(data.status == 0){
                cObj.find("strong").text("Follow");
                cObj.parent("div").find(".tl-follower").text(parseInt(c)-1);
              }else{
                cObj.find("strong").text("UnFollow");
                cObj.parent("div").find(".tl-follower").text(parseInt(c)+1);
              }
             $('#following_' + data.auth_id).html(data.count);
           }
        });
    });      
}); 