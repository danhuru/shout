
$(function(){

    //Show Login Popup


    $("#overlay").fadeIn();
    $("#popup_endorse").fadeIn();
    $("#endorse_popup1").click(function(){

        $("#overlay").fadeOut();
        $("#popup_endorse").fadeOut();

    });

    // Endorse hobbies

  $(".endorse").click(function()
  {

      $("#overlay").fadeIn();

      // Obtain hobby and profile
      hobby_id=$(this).siblings("#hobby_id").text();
      var el=$(this).siblings("#hobby_id");
      url=location.href;
      urlString = [];
      urlString = url.split("/");
      urlString.reverse();
      thisUser=urlString[0];

      //Check if endorsement exists

      $.post("/shout/viewprofile/check_already_endorsed_hobby",{hobby_id: hobby_id, thisUser: thisUser,loggedin: 0},function(data,status)
      {
          console.log(data)
      if (data=='TRUE')
      {
          $("#popup_already_endorsed").fadeIn();
      }
      else
      {
        $.post("/shout/viewprofile/add_hobby_endorsement/",{hobby_id: hobby_id, thisUser: thisUser,loggedin: 0},function(data,status)
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
        aboutme_id=$(this).siblings("#aboutme_id").text();
        var el=$(this).siblings("#aboutme_id");
        url=location.href;
        urlString = [];
        urlString = url.split("/");
        urlString.reverse();
        thisUser=urlString[0];

        //Check if endorsement exists

        $.post("/shout/viewprofile/check_already_endorsed_aboutme",{aboutme_id: aboutme_id, thisUser: thisUser,loggedin: 0},function(data,status)
        {
            console.log(data);
            if (data=='TRUE')
            {
                $("#popup_already_endorsed").fadeIn();
            }
            else
            {
                $.post("/shout/viewprofile/add_aboutme_endorsement/",{aboutme_id: aboutme_id, thisUser: thisUser,loggedin: 0},function(data,status)
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

            $(this).children().attr("src", '/shout/images/plus.png');
            $(this).children().attr("width", '27px');
            var el=$(this).siblings("#hobby");
            el.css("border","2px solid black");
            el.css('border-radius','5px');
            el.css('color','orange');

        },
        function()
        {
            $(this).children().attr("src", '/shout/images/plus_grey.png')
            $(this).children().attr("width", '25px');
            var el=$(this).siblings("#hobby");
            el.css("border","2px solid transparent");
            //  el.css('border-radius','5px');
            el.css('color','white');

        }
    );

    $(".endorse2").hover
    (
        function()
        {

            $(this).children().attr("src", '/shout/images/plus.png');
            $(this).children().attr("width", '27px');
            var el=$(this).siblings("#hobby");
            el.css("border","2px solid black");
            el.css('border-radius','5px');
            el.css('color','orange');

        },
        function()
        {
            $(this).children().attr("src", '/shout/images/plus_grey.png')
            $(this).children().attr("width", '25px');
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
        $("#popup_message").fadeOut();
        $("#popup_already_endorsed").fadeOut();
        $("#popup_endorse_success").fadeOut();
        $("#overlay").fadeOut();
    });

    $("#text_message").click(function()
    {
        $("#popup_message").fadeIn();
        $("#overlay").fadeIn();
    })

});