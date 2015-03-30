<?php include 'View/header.php'; ?>
<div id="msg-main">
    <?php
        require_once 'Model/database.php';
        require_once 'Model/message.php';
        require_once 'Model/user.php';
        require_once 'Model/messagingDB.php';

        $users = Messaging::getConversationsByUser(1);

        $messages;

        if(!isset($_GET['action'])) {
            $messages = Messaging::getMessagesBySenderReceiver(1,$users[0]->getID());
        }
        else if($_GET['action'] == 'add-msg') {
            $message = new Message(1, $_GET['id'], $_POST['msg-txt']);
            Messaging::addMessage($message);
            $messages = Messaging::getMessagesBySenderReceiver(1,$_GET['id']);
        }
        else {
            $messages = Messaging::getMessagesBySenderReceiver(1,$_GET['id']);
        }

        require_once 'View/messaging.php';
//                require_once 'View/msg-box.php';
    ?>

    <script>
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
                      document.getElementById("msg-main").innerHTML=xmlhttp.responseText;
                    }
                }


                var url = "index.php?action=view&id=<?=$_GET['id']?>";
                xmlhttp.open("GET",url,true);
                xmlhttp.send();

            },10000);
        });

    </script>

</div>
        
<?php include 'View/footer.php'; ?>
    
