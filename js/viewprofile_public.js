
$(function(){

    // Endorse hobbies


  $(".endorse").click(function(e)
  {

    //  showHobbyPopup
    //  alert($(this).html());

      $("#popup_endorse_hobbies").fadeIn();
      $("#overlay").fadeIn();


      var hobby=$(this).siblings("#hobby").text();

      $("#endorse_popup1").click(function()
      {

          // Add endorsement
          url=location.href;
          var urlString = [];
          urlString = url.split("/");
          urlString.reverse();
          thisUser=urlString[0];

          $.post("/shout/viewprofile/add_hobby_endorsement/",{hobby: hobby, thisUser: thisUser},function(data,status)
          {
             $("#popup_endorse_hobbies").html(data);
          });

      });

      e.stopPropagation();


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

    // Endorse about me

  $(".endorse2").click(function(e)
    {

     //  showEndorsementPopup

        $("#popup_endorse_aboutme").fadeIn();
        $("#overlay").fadeIn();
        e.stopPropagation();
    });


    //Click overlay div

    $("#overlay").click(function()
    {
        $("#popup_endorse_hobbies").fadeOut();
        $("#popup_endorse_aboutme").fadeOut();
        $("#overlay").fadeOut();
    });



});