$(function()
{
    $('#newsfeed').jScrollPane();

    // Events colouring

    $(".status").each(function()
    {
      if ( $(this).text()=='Confirm/Dismiss' || $(this).text()=='View message' )
      {
       // $(this).parent().css('background-color','grey');
        $(this).parent().css('border','2px solid orange');
      }
    });

    $(".status").click(function()
    {
            $(this).parent().animate(

            {

                "border-top-color": "rgba(50, 50, 50, 0.70)",
                "border-bottom-color": "rgba(50, 50, 50, 0.70)",
                "border-left-color": "rgba(50, 50, 50, 0.70)",
                "border-right-color": "rgba(50, 50, 50, 0.70)"

            }, 800);


    });

});