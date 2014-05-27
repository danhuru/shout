
function demo (){alert("submitted");}


$(function(){


/////////////Hobbies/////////////

//Container Behavior

//Mouse enters input, show default hint, delete default text

$("#addhobby").focus(function(){
    $("#addhobbiessuggestions").show();
    if ($(this).val()=="type here...")
    $(this).val("");
});

//Mouse leaves input, show default input text

$("#addhobby").blur(function(){
    if ($(this).val()=="")
    $(this).val("type here...");
});

//Mouse leaves div, hide suggestions

$("#addhobbies").mouseleave(function(){
    $("#addhobbiessuggestions").hide();
    });

//Mouse reenters input, show previous suggestions

    $("#addhobby").mousedown(function(){
        $("#addhobbiessuggestions").show();
    });


//Add hobby html

    function add_hobby(hobby)
    {
        el='<div id="hobbydetails">';

        el=el+'<div id="hobby_name">'+hobby+'</div>'; // add hobby title

        // show images
        el=el+'<div id="img_endorse">';

        el=el+'<img src="images/endorse_nr_grey.png" width="25px" ></img>';
        el=el+'<img src="images/endorse_nr_grey.png" width="25px" ></img>';
        el=el+'<img src="images/endorse_nr_grey.png" width="25px" ></img>';
        el=el+'<img src="images/endorse_nr_grey.png" width="25px" ></img>';
        el=el+'<img src="images/endorse_nr_grey.png" width="25px" ></img>';

        el=el+'</div>';

        el=el+'<div id="rating">0/5</div>'; // add default rating

        el=el+'<div id="delete">x</div>';

        el=el+'<div id="details">';

        el=el+'<input type="text" id="detailsinput" autocomplete="off" value="what, where, with who..."></input>';

        el=el+'</div>'; //end details

        el=el+'</div>'; //end div

        $("#showhobbies").after(el);

        //Mouse enters input details

        $("#detailsinput").focus(function(){
            if ($(this).val()=="what, where, with who...")
                $(this).val("");
        });

        //Mouser leaves input details

        $("#detailsinput").blur(function(){

            if ($(this).val()=="")
            $(this).val("what, where, with who...");
        });

        $("#delete").click(function(){

            $(this).parent("#hobbydetails").remove();

        });
    }

//Add aboutme html

    function add_aboutme(aboutme)
    {
        el='<div id="aboutmecircle" style="background-image: url(\'/shout/images/circle'+Math.floor((Math.random() * 4) + 1)+'.png\')">';
        el=el+'<div id="what">';
        el=el+aboutme;
        el=el+'</div>';
        el=el+'<div id="deletecircle">x</div>';
        el=el+'</div>';
        $("#showaboutme").after(el);
        $("#deletecircle").click(function(){
        $(this).parent("#aboutmecircle").remove();
        });

    }
//Get Results

function getResults(str){

    if (str) {
        $.get("create/get_hints/"+str,function(data){
            $("#addhobbiessuggestions").html(data);
            $("#addhobbiessuggestions").show();
            $("text").click(function(){
            $("#addhobby").val($(this).text());
            $("#addhobbiessuggestions").hide();
            $("#showhobbies").show();
            add_hobby($(this).text()); // Call Add Hobby HTML
            $("#addhobby").val("type here...");
            });
        });

     }
    else $("#addhobbiessuggestions").hide();
}

//Start typing

    $("#addhobby").keyup(function(){
        getResults($(this).val());
    });

/////////////About Me/////////////

//Container Behavior

//Mouse enters input, show default hint, delete default text

    $("#addaboutme").focus(function(){
        if ($(this).val()=="type here...")
        {
            $(this).val("");
            $("#addaboutmesuggestions").show();
        }
    });

//Mouse leaves input, show default input text

    $("#addaboutme").blur(function(){
        if ($(this).val()=="")
            $(this).val("type here...");
    });

//Mouse leaves div, hide suggestions

    $("#addaboutme").mouseleave(function(){
        $("#addaboutmesuggestions").hide();
    });

//Mouse reenters input, show previous suggestions

//Click Add button

    $("#addaboutmebutton").click(function(){

         if($("#addaboutme").val()!="type here...")
         {
             $("#showaboutme").show();
             add_aboutme($("#addaboutme").val());
             $("#addaboutme").val("type here...");
         }

        // else
        // {
         //    $("#jquerypopup").text("Try to be original!");
          //   $("#jquerypopup").show();
        // }

    });

//Upload image


    $("#uploadpic").click(function(){

       alert( $("#bckpicbutton").attr("src") );

    });

});