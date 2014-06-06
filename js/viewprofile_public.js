
$(function(){

    //Show Login Popup


    $("#overlay").fadeIn();
    $("#popup_endorse").fadeIn();
    $("#endorse_popup1").click(function(){

        $("#overlay").fadeIn();
        $("#popup_endorse").fadeIn();

    });


    // Endorse hobbies

  $(".endorse").click(function()
  {

      $("#overlay").fadeIn();

      // Obtain hobby and profile
      hobby=$(this).siblings("#hobby").text();
      var el=$(this).siblings("#hobby");
      url=location.href;
      urlString = [];
      urlString = url.split("/");
      urlString.reverse();
      thisUser=urlString[0];

      //Check if endorsement exists

      $.post("/shout/viewprofile/check_already_endorsed_hobby",{hobby: hobby, thisUser: thisUser},function(data,status)
      {
      if (data=='TRUE')
      {
          $("#popup_already_endorsed").fadeIn();
      }
      else
      {
        $.post("/shout/viewprofile/add_hobby_endorsement/",{hobby: hobby, thisUser: thisUser},function(data,status)
          {
              $("#popup_endorse_success").html(data);
              $("#popup_endorse_success").fadeIn();
          });
      }
      });

  });

    // Endorse about me

    $(".endorse2").click(function()
    {

        $("#overlay").fadeIn();

        // Obtain hobby and profile
        aboutme=$(this).siblings("#what").text();
        var el=$(this).siblings("#what");
        url=location.href;
        urlString = [];
        urlString = url.split("/");
        urlString.reverse();
        thisUser=urlString[0];

        //Check if endorsement exists

        $.post("/shout/viewprofile/check_already_endorsed_aboutme",{aboutme: aboutme, thisUser: thisUser},function(data,status)
        {
            if (data=='TRUE')
            {
                $("#popup_already_endorsed").fadeIn();
            }
            else
            {
                $.post("/shout/viewprofile/add_aboutme_endorsement/",{aboutme: aboutme, thisUser: thisUser},function(data,status)
                {
                    $("#popup_endorse_success").html(data);
                    $("#popup_endorse_success").fadeIn();
                });
            }
        });

    });

    // Hover endorse button

   $(".endorse").hover
   (
       function()
    {

        var el=$(this).siblings("#hobby");
        el.css("border","2px solid black");
        el.css('border-radius','5px');
        el.css('color','orange');

    },
       function()
       {
           var el=$(this).siblings("#hobby");
           el.css("border","2px solid transparent");
         //  el.css('border-radius','5px');
           el.css('color','white');

       }
   );




    //Click overlay div

    $("#overlay").click(function()
    {
        $("#popup_endorse").fadeOut();
        $("#popup_already_endorsed").fadeOut();
        $("#popup_endorse_success").fadeOut();
        $("#overlay").fadeOut();
    });



});