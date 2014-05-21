window.fbAsyncInit = function() {
    FB.init({
        appId      : '246997218819865',
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
    });
    // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
    // for any authentication related change, such as login, logout or session refresh. This means that
    // whenever someone who was previously logged out tries to log in again, the correct case below
    // will be handled.
     FB.Event.subscribe("auth.logout", function() {window.location = '/shout'});
};

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

function logout(){

FB.logout(function(response) {
    // user is now logged out
    window.location.assign('/shout');
});



}