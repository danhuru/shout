$(function()
{
    $('#showSearchResults').jScrollPane();
});

    function searchResult(str) {
        document.getElementById("showSearchResults").innerHTML="<p id='loader'>Loading profiles...<br><img src='images/ajax-loader4.gif'></p>";
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
                document.getElementById("showSearchResults").innerHTML=xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET","search/searchResult/"+str,true);
        xmlhttp.send();
    }