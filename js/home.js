$(function()
{
    $('#newsfeed').jScrollPane();

    // Events colouring

    $(".status").each(function()
    {
      if ( $(this).text()=='Confirm' || $(this).text()=='View message' )
      {
       // $(this).parent().css('background-color','grey');
        $(this).parent().css('border','2px solid orange');
      }
    });

    $("#ok").click(function()
    {

        $("#overlay").fadeOut();
        $("#popup_show_message").fadeOut();

    });
    $("#reply").click(function(){

        $("#popup_show_message").fadeOut();
        $("#popup_message").fadeIn();

    });


    $(".status").click(function()
    {

        thisStatus=$(this);
        type=$(this).text();
        event_id=$(this).siblings("#userid").text();

        if(type=="View message" || type=="Viewed")
        {
            $.post("home/view_message",{event_id: event_id},function(data,status)
            {
                $("#overlay").fadeIn();
                $("#popup_show_message").find("#messsagetext").html(data);
                $("#popup_show_message").fadeIn();
                setTimeout(function(){
                  thisStatus.text("Viewed");
                }, 500);


            });
        }

        else if (type=="Confirm")
        {
            $.post("home/confirm_endorsement",{event_id: event_id},function(data,status)
            {
                console.log(data);
                   setTimeout(function(){
                    thisStatus.text("Confirmed");
                }, 500);

            });

        }

        $(this).parent().animate(

            {

                "border-top-color": "rgba(50, 50, 50, 0.70)",
                "border-bottom-color": "rgba(50, 50, 50, 0.70)",
                "border-left-color": "rgba(50, 50, 50, 0.70)",
                "border-right-color": "rgba(50, 50, 50, 0.70)"

            }, 800);



    });

    $("#send").click(function(){

        message_content=$("#content").val();

        thisUser=$("#popup_show_message").find("#userid").text();

        alert(thisUser);

       // thisUser=$("#userid").text();

        $.post("/shout/search/send_message/",{thisUser: thisUser, message_content: message_content},function(data,status)
        {
            //console.log(data);
            $("#popup_message").fadeOut();
            $("#popup_show_message").fadeOut();
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