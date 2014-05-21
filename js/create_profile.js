function showHint(str)
        {
            var xmlhttp;
            if (str.length==0)
            {
            document.getElementById("txtHint").innerHTML="";
            return;
            }
if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
                }
else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                var custom_response=xmlhttp.responseText;
                document.getElementById("txtHint").innerHTML=custom_response ;

                }
}

xmlhttp.open("GET","create_profile/get_hints/"+str,true);
xmlhttp.send();

}
function addPassion(str)
{
    var para=document.createElement("text");
    var node=document.createTextNode(str);
    para.appendChild(node);
    var element=document.getElementById("added");
    element.appendChild(para);
    document.getElementById("added").innerHTML=str ;
}