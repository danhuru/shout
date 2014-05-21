// Here we run a very simple test of the Graph API after login is successful.
// This testAPI() function is only called in those cases.
function Connected() {
     window.location.assign("index.php/login/redirect");
}

function invite()
{
    alert("Inviting");
    FB.ui({
        app_id:'246997218819865',
        method: 'send',
        name: "Invitation",
        to: "<?php Print(1570612986); ?>",
        link: 'www.webuildshout.com',
        description:'Rate me please!'
    });
}