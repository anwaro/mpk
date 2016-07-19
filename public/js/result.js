$(function(){
    $(".tram").click(function(){
        console.log("#showTramStop"  + $(this).data("line"));
        $("#tramStop"  + $(this).data("line")).val($(this).attr("id"));
        $("#showTramStop"  + $(this).data("line")).submit();
        
    });
});