$(function()
{
    $( ".popup_endorse" ).draggable({ revert: false });
    $( ".popup" ).draggable({ revert: false });

    $("#overlay").click(function()
    {
        $("#popup_endorse").fadeOut();
        $("#popup_message").fadeOut();
        $("#popup_already_endorsed").fadeOut();
        $("#popup_endorse_success").fadeOut();
        $("#popup_message_success").fadeOut();
        $("#popup_show_message").fadeOut();
        $("#overlay").fadeOut();
    });




});