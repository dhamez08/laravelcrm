$(document).on("click",".social-icons a",function(){
    $("div.content").prepend('<div class="alert alert-info">Connecting to '+$(this).attr('data-original-title')+'</div>');
})