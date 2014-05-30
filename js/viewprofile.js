

$(function(){

    // Popup hobbies

    $("#view_hobbies").click(function(e)
    {
        $("#popup_hobbies").fadeIn();
        $("#overlay").fadeIn();
        e.stopPropagation();
    }
    );

    $("#overlay").click(function()
    {
        $("#popup_hobbies").fadeOut();
        $("#overlay").fadeOut();
    });



    // Popup aboutme

    $("#view_aboutme").click(function(e)
        {
            $("#popus_aboutme").fadeIn();
            e.stopPropagation();
        }
    );

    $("body").click(function()
    {
        $("#popus_aboutme").fadeOut();
    });

});