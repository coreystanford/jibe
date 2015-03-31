$(document).ready(function() {

//        var element = document.getElementById("msg-content");
//        var scrollPos = element.scrollTop;
//        
//        
//       
//        $("#msg-content").on('scroll', function(){
//            scrollPos = element.scrollTop;
//            alert(scrollPos);
//        });
//        
//        setInterval(function() {
//            scrollPos = element.scrollTop;
//        }, 1);

        setInterval(function()
        {

//            scrollPos = element.scrollTop;

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


            //var url = "index.php?action=view&id=<?=$_GET['id']?>";
            var url = "messaging-ajax.php?id=<?=$_GET['id']?>";
            xmlhttp.open("GET",url,true);
            xmlhttp.send();

//            element.scrollTop = scrollPos;

        },5000);
    });