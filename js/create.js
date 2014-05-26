
$(function(){

//Show Container

$("#addhobby").focus(function(){
    $("#addhobbiessuggestions").show();
});



var myArray = [];

//Get Results

function getResults(str){

    if (str) {

        $.get("create/get_hints/"+str,function(data){

            $("#addhobbiessuggestions").html(data);

            $("#addhobbiessuggestions").show();

            $("text").click(function(){

                myArray.push($(this).text());

                text="";

                for (var i = 0; i < myArray.length; i++) {
                    text = text+myArray[i]+',';
                }


                $("#addhobby").val(text);


              /*  $("#addhobbiessuggestions").val(function(i,origText)
                 {
                 return origText+$(this).text()+",";
                 }
                );
*/
                $("#addhobbiessuggestions").hide();
            });


        });

        //Click on hobby suggestion




    }
    else $("#addhobbiessuggestions").hide();

}

//Start typing

    $("#addhobby").keyup(function(){

        str=$(this).val().split(",");
        term=str.reverse()[0];

        getResults(term);



    });



});