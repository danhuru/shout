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

$(function(){

    //Main menu

    $("#mainmenu").click(function(){
        $("#mainmenu_expanded").toggle();
    });
    $("#mainmenu_expanded").mouseleave(function(){
        $("#mainmenu_expanded").hide();
    });

    //Right menu

    $("#rightmenu").find("img").hover(
        function(){
            $(this).attr("src",function(i,origValue){
                return origValue.replace(".jpg","_hover.jpg");
            });
        },
        function(){
            $(this).attr("src",function(i,origValue){
                return origValue.replace("_hover.jpg",".jpg");
            });
        });
});


  function redirect(url)
    {
        window.location.assign('/shout/'+url);
        }



function logout(){

FB.logout(function(response) {
    // user is now logged out
    window.location.assign('/shout');
});



}