$(document).ready(function(){
    
    $(".list-msg-receive").show();
    $(".list-msg-send").show();

    $(".msg-send").click(function(){
    $(".list-msg-receive").hide();
    $(".list-msg-send").show();
    });

    $(".msg-receive").click(function(){
    $(".list-msg-receive").show();
    $(".list-msg-send").hide();
    });

});