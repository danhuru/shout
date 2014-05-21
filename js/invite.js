
    function invite(id,url)
    {
        FB.ui({
            app_id:'246997218819865',
            method: 'send',
            name: "Invitation",
            to: id,
            link: url,
            description:'Rate me please!'
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
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        } else {  // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("showfriendsresults").innerHTML=xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET","invite/showfriends/"+str,true);
        xmlhttp.send();
    }