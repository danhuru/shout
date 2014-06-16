

$(function()
{

    value=0;
    value1=1;
    value2=2;

    value=value1+value2;

    $.get("/shout/home/show_events/",{value:value},function(data){

        $('#newsfeed').html(data);

        $(".status").each(function()
        {
            if ( $(this).text()=='Confirm' || $(this).text()=='View message' )
            {
                // $(this).parent().css('background-color','grey');

                $(this).parent().css('border','2px solid orange');
            }
        });


    });


    $('#chkmsg').change(function()
    {



        if($('#chkmsg').prop('checked')==true) value1=1; else value1=0;
        if($('#chkend').prop('checked')==true) value2=2; else value2=0;

        value=value1+value2;

        $.get("home/show_events/",{value:value},function(data){

            $('#newsfeed').html(data);

            $(".status").each(function()
            {
                if ( $(this).text()=='Confirm' || $(this).text()=='View message' )
                {
                    // $(this).parent().css('background-color','grey');

                    $(this).parent().css('border','2px solid orange');
                }
            });

        });

    })

    $('#chkend').change(function()
    {

        if($('#chkmsg').prop('checked')==true) value1=1; else value1=0;
        if($('#chkend').prop('checked')==true) value2=2; else value2=0;

        value=value1+value2;

        $.get("home/show_events/",{value:value},function(data){

            $('#newsfeed').html(data);

            $(".status").each(function()
            {
                if ( $(this).text()=='Confirm' || $(this).text()=='View message' )
                {
                    // $(this).parent().css('background-color','grey');

                    $(this).parent().css('border','2px solid orange');
                }
            });

        });

    })


    setInterval(function(){

        value=value1+value2;

        $.get("/shout/home/show_events/",{value:value},function(data){

            console.log('refresh');

            $('#newsfeed').fadeOut();

            $('#newsfeed').html(data);

            $(".status").each(function()
            {
                if ( $(this).text()=='Confirm' || $(this).text()=='View message' )
                {
                    // $(this).parent().css('background-color','grey');
                    $(this).parent().css('border','2px solid orange');
                }
            });

            $('#newsfeed').fadeIn();

        });

    },30000);


    // Events colouring

    $("#ok").click(function()
    {

        $("#overlay").fadeOut();
        $("#popup_show_message").fadeOut();

    });

    $("#reply").click(function(){

        $("#popup_show_message").fadeOut();
        $("#popup_message").fadeIn();

    });


    $("body").on('click','.status',function(){

    //$(".status").click(function()


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
                $.get("/shout/header/refresh_header/",function(data){

                    console.log(data);

                    alertsArray = [];
                    alertsArray = data.split(",");
                    messages=alertsArray[0];
                    alerts=alertsArray[1];

                    if (messages) {
                        $('#messages').text(messages);
                        $('#messages').show();
                    }

                    else $('#messages').fadeOut();

                    if (alerts) {
                        $('#alerts').text(alerts);
                        $('#alerts').show();
                    }

                    else $('#alerts').fadeOut();

                    console.log(' '+messages+' '+alerts);

                });
                setTimeout(function(){
                  thisStatus.text("Viewed");
                }, 500);


            });
        }

        else if (type=="Confirm")
        {
            $.post("home/confirm_endorsement",{event_id: event_id},function(data,status)
            {
              //  console.log(data);
                $.get("/shout/header/refresh_header/",function(data){

                    console.log(data);

                    alertsArray = [];
                    alertsArray = data.split(",");
                    messages=alertsArray[0];
                    alerts=alertsArray[1];

                    if (messages) {
                        $('#messages').text(messages);
                        $('#messages').show();
                    }
                    if (alerts) {
                        $('#alerts').text(alerts);
                        $('#alerts').show();
                    }

                    console.log(' '+messages+' '+alerts);

                });
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