//Author: Wilston Dsouza
//jQuery AJAX code to check for new messages from the database

$(document).ready(function() {

        setInterval(function()
        {

            var xmlhttp;
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
                  document.getElementById("msg-ajax").innerHTML=xmlhttp.responseText;
                }
            }

            var url = "messaging-ajax.php?id=<?=$_GET['id']?>";
            xmlhttp.open("GET",url,true);
            xmlhttp.send();

        },5000);
    });