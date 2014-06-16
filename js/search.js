
function searchResult(str) {
    document.getElementById("showSearchResults").innerHTML="<p id='loader'>Loading profiles...<br><img src='images/ajax-loader4.gif'></p>";
    if (str.length==0 || str=="type a hobby...") {
        str="show_me_all";
    }

    $.get("search/searchResult/",{str:str},function(data,status)
    {
        $("#showSearchResults").html(data);
    });

}


$(function(){

    $.get("search/searchResult/show_me_all",function(data,status)
    {
           $("#showSearchResults").html(data);
    });

});

$('#showSearchResults').on('click','.pressmessage',function(){


        $("#popup_message").fadeIn();
        $("#overlay").fadeIn();

        thisUser=$(this).parents("#profile_info").siblings("#profile_info_left").children("#userid").text();

    $("#send").click(function(){

        message_content=$("#content").val();



       $.post("/shout/search/send_message/",{thisUser: thisUser, message_content: message_content},function(data,status)
       {
       //console.log(data);
       $("#popup_message").fadeOut();
       $("#popup_message_success").html("Your message was sent!");
       $("#popup_message_success").fadeIn();
       setTimeout(function(){
       $("#content").val("type message here...");
       }, 500);

       });


        });


    $("#content").focus(function(){
        if ($(this).val()=="type message here...")
            $(this).val("");
    });

//Mouse leaves input, show default input text

    $("#content").blur(function(){
        if ($(this).val()=="")
            $(this).val("type message here...");
    });

});
