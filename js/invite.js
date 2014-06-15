
    function invite(id,url)
    {
        FB.ui({
            app_id:'246997218819865',
            method: 'send',
            name: "Invitation",
            to: id,
            link: url,
            description:'Hi! Please endorse my profile on Shout!'
        },function(response)
            {
                if (response && !response.error_code) {
                    element='friend_'+id;
                    h=document.getElementById(element);
                    h.innerHTML="Invited";
                    h.style.color = "black";
                } else {
                    alert('Error while posting.');
            }
            }
        );

    }

    function showResult(str) {
        document.getElementById("showfriendsresults").innerHTML="<p id='loader'>Loading profiles...<br><img src='images/ajax-loader4.gif'></p>";
        if (str.length==0) {
            str="show_me_all";
        }

        $.get("invite/showfriends/",{str:str},function(data,status)
        {
            $("#showfriendsresults").html(data);
        });

    }