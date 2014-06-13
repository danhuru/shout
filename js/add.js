

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

        el=el+'<div id="hobby_name" class="hobbyname">'+hobby+'</div>'; // add hobby title

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

        el=el+'<input type="text" id="detailsinput" class="hobbydetails" autocomplete="off" value="what, where, with who..."></input>';

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
        el=el+'<div id="what" class="aboutme">';
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

        var bckpic;

        function getDoc(frame) {
            var doc = null;

            // IE8 cascading access check
            try {
                if (frame.contentWindow) {
                    doc = frame.contentWindow.document;
                }
            } catch(err) {
            }

            if (doc) { // successful getting content
                return doc;
            }

            try { // simply checking may throw in ie8 under ssl or mismatched protocol
                doc = frame.contentDocument ? frame.contentDocument : frame.document;
            } catch(err) {
                // last attempt
                doc = frame.document;
            }
            return doc;
        }

        $("#multiform").submit(function(e)
        {

            $("#multi-msg").html('<img src="/shout/images/ajax-loader4.gif"/>');

            var formObj = $(this);
            var formURL = formObj.attr("action");

            if(window.FormData !== undefined)  // for HTML5 browsers
//	if(false)
            {

                var formData = new FormData(this);
                $.ajax({
                    url: formURL,
                    type: 'POST',
                    data:  formData,
                    mimeType:"multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data, textStatus, jqXHR)
                    {
                        if(data.substr(0,6)=='Error:') $("#multi-msg").text(data);
                        else
                        {
                            $("#multi-msg").html('');
                            var url='/shout/images/upload/' + data;
                            $('#main').css('background-image', 'url(' + url + ')');
                            bckpic=1;
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        $("#multi-msg").text(errorThrown);
                    }
                });
                e.preventDefault();
           //     e.unbind();
            }
            else  //for older browsers
            {
                //generate a random id
                var  iframeId = 'unique' + (new Date().getTime());

                //create an empty iframe
                var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

                //hide it
                iframe.hide();

                //set form target to iframe
                formObj.attr('target',iframeId);

                //Add iframe to body
                iframe.appendTo('body');
                iframe.load(function(e)
                {
                    var doc = getDoc(iframe[0]);
                    var docRoot = doc.body ? doc.body : doc.documentElement;
                    var data = docRoot.innerHTML;
                  //  $("#multi-msg").html('<pre><code>'+data+'</code></pre>');
                    $("#multi-msg").html('');
                    var url='/shout/images/upload/' + data;
                    $('#main').css('background-image', 'url(' + url + ')');
                    bckpic=1;
                });

            }

        });


        $("#multi-post").click(function()
        {

            $("#multiform").submit();

        });


// Submit Profile form


    $("#submitprofile").click(function()

       {

           //Remove errors

           $(document).find(".error").remove();

           //Define Error array

           var errorList = [];

            //Collect hobby data

           var hobbyList = [];
           var hobbyDetailsList=[];


           $(".hobbyname").each(function() {


               hobbyList.push($(this).text());

               //Fetch hobby details

               var hobbydetails=$(this).siblings("#details").children("#detailsinput");
               if (hobbydetails.val()=="" || hobbydetails.val()=="what, where, with who...")
               {

                   //$("p").append("Some appended text.");
                   //<div id="multi-msg"></div>
                   hobbydetails.after('<div id="errormsg" class="error">Please share some details about your hobby.</div>');
                   errorList.push("Please share some details about your hobby.");
                   //add here div with relative position
                  return false;
               }
              else hobbyDetailsList.push(hobbydetails.val());

           });



           //Collect about me data

           var aboutmeList = [];
           $(".aboutme").each(function() { aboutmeList.push($(this).text()) });



            if (errorList.length==0)  {

                if (hobbyList.length!=0 && aboutmeList.length!=0)
                {
                 $.post('add/process_form', {
                    hobbylist: hobbyList,
                    hobbydetailslist: hobbyDetailsList,
                    aboutmelist: aboutmeList,
                    bckpic: bckpic
                } , function(data,status){
                  //  alert("Data: " + data + "\nStatus: " + status);

                     window.location.href = "viewprofile";

                });
                }
                if (hobbyList.length!=0 && aboutmeList.length==0)
                {
                    $.post('add/process_form', {
                        hobbylist: hobbyList,
                        hobbydetailslist: hobbyDetailsList,
                        aboutmelist: null,
                        bckpic: bckpic
                    } , function(data,status){
                        //  alert("Data: " + data + "\nStatus: " + status);

                        window.location.href = "viewprofile";

                    });
                }
                if (hobbyList.length==0 && aboutmeList.length!=0)
                {
                    $.post('add/process_form', {
                        hobbylist: null,
                        hobbydetailslist: hobbyDetailsList,
                        aboutmelist: aboutmeList,
                        bckpic: bckpic
                    } , function(data,status){
                        //  alert("Data: " + data + "\nStatus: " + status);

                        window.location.href = "viewprofile";

                    });
                }
            }




          }

    );

});