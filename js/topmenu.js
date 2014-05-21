

function icon_switch(x, img_desc)
{
    img_desc='images/'.concat(img_desc);
    x.src=img_desc;
}

function dropdown()

    {
        var x=document.getElementById("mainmenu_expanded");
        x.style.display="block";
        }

 function dropdown_fade()

    {
        var x=document.getElementById("mainmenu_expanded");
        x.style.display="none";
        }

  function redirect(url)
    {
        window.location.assign(url);
        }


function dropdown()

{
    var x=document.getElementById("mainmenu_expanded");
    x.style.display="block";
}
