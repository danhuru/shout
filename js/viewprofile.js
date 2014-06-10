
$(function(){

    // Popup hobbies



    $("#view_hobbies").click(function(e)
    {
        $("#popup_hobbies").fadeIn();
        $("#overlay").fadeIn();
        e.stopPropagation();
    }
    );


    // Popup aboutme

    $("#view_aboutme").click(function(e)
        {
            $("#popup_aboutme").fadeIn();
            $("#overlay").fadeIn();
            e.stopPropagation();
        }
    );

    //Click overlay div

    $("#overlay").click(function()
    {
        $("#popup_hobbies").fadeOut();
        $("#popup_aboutme").fadeOut();
        $("#overlay").fadeOut();
    });


    $("#text_message").click(function()
    {
        $("#popup_message").fadeIn();
        $("#overlay").fadeIn();
    })


});