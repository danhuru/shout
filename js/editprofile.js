function confirm_delete() {
    if (confirm("Are you sure you want to remove this hobby from your profile?") == true) {
        return true;
    } else {
        return false;
    }
}

function delete_hobby(x,user,hobby)

{

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            ;
        }
    }



   if (confirm_delete()==true) {

    xmlhttp.open("POST","editprofile/delete_hobby/"+user+"/"+hobby,true);
       // xmlhttp.send();
    x.innerHTML='Deleted';
   }
}

function save(x){

    // update database

}

function cancel(x){


      alert(x.parentNode.parentNode.firstChild.innerHTML);

   // var div = document.createElement('div id="details');
   // document.body.appendChild(div);
    var newChild=document.createTextNode(x.parentNode.parentNode.firstChild.innerHTML);


  x.parentNode.parentNode.replaceChild(newChild,x.parentNode.parentNode.firstChild);

}


function edit_details(x, hobby_details)

{

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            ;
        }
    }
        var createinput='<input id="detail_input" value="'+hobby_details+'"</input>';
        var newbuttons='<button class ="smallbutton" onclick="save(this)">Save</button><button class ="smallbutton_cancel" onclick="cancel(this)">Cancel</button>';

        x.parentNode.firstChild.innerHTML=createinput;
        x.parentNode.lastChild.innerHTML=newbuttons;

}


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
        $("#popus_aboutme").fadeIn();
        $("#overlay").fadeIn();
        e.stopPropagation();
    }
);

//Click overlay div

$("#overlay").click(function()
{
    $("#popup_hobbies").fadeOut();
    $("#popus_aboutme").fadeOut();
    $("#overlay").fadeOut();
});
