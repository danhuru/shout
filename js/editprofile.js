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
    $("#popup_delete").fadeOut();
    $("#overlay").fadeOut();
    $("#ok").off("click");
});

    $("#nobutton").click(function()
    {
        $("#popup_delete").fadeOut();
        $("#overlay").fadeOut();
        $("#ok").off("click");
    });

    $("#okbutton").click(function()
    {
        $("#popup_delete").fadeOut();
        $("#overlay").fadeOut();
        $("#ok").off("click");
    });



    $(".delete").click(function()
    {


     hobby_id=$(this).siblings("#hobby_id").text();
     aboutme_id=$(this).siblings("#aboutme_id").text();

     parent=$(this).parent();

   //  if(hobby_id) alert(hobby_id); else alert('no hobby');

    // if(aboutme_id) alert(aboutme_id); else alert('no aboutme');

     $("#popup_delete").fadeIn();
     $("#overlay").fadeIn();

       $("#ok").on("click",function(){

           if(hobby_id)
           $.post('editprofile/delete_hobby', {
               hobby_id: hobby_id,
           } , function(data,status){

            parent.remove();

           });

           if(aboutme_id)
           $.post('editprofile/delete_aboutme', {
               aboutme_id: aboutme_id,
           } , function(data,status){

            parent.remove();

           });

       })

 })

    $('.edit').click(function()
 {

    $(this).parent().hide();

    $(this).parent().after('<div id="details"><input id="editbox1" type="text" value="'+$(this).siblings().text()+'"></input></div><div id="savecancel"><text class="save">Save</text> | <text class="cancel">Cancel</text></div>');

     $(".cancel").on('click',function(){
         $(this).parent().siblings('#initial').show();
         $(this).parent().siblings('#details').remove();
         $(this).parent().remove();

     });
     $(".save").on('click',function(){


             newvalue=$(this).parent().siblings('#details').children('#editbox1').val();

            if(newvalue)

            {

             hobby_id=$(this).parent().siblings('#hobby_id').text();
             $(this).parent().siblings('#initial').children('#details').text(newvalue);
             $(this).parent().siblings('#initial').show();
             $(this).parent().siblings('#details').remove();
             $(this).parent().remove();

             $.post('editprofile/update_hobby_details', {
                    hobby_id: hobby_id,
                    hobby_details: newvalue
                } , function(data,status){

                   console.log(data);

                });
            }
     });



     //edit
     //call update function

 })

});