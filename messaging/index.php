<?php
    require_once '../model/database.php';
    require_once '../model/message.php';
    require_once '../model/user.php';
    require_once '../model/messagingDB.php';
    require_once '../model/userDB.php';

    $users = Messaging::getConversationsByUser(1);

    $messages;

    if(!isset($_GET['user-action']) && !isset($_POST['user-action'])) {
        $messages = Messaging::getMessagesBySenderReceiver(1,$users[0]->getID());
        require_once 'messaging.php';
    }
    else if(isset ($_POST['user-action']) && $_POST['user-action'] == 'add-msg') {
        $message = new Message(1, $_GET['user-id'], $_POST['msg-txt']);
        Messaging::addMessage($message);
        $messages = Messaging::getMessagesBySenderReceiver(1,$_GET['user-id']);
        require_once 'messaging.php';
    }
    else if(isset ($_GET['user-action']) && $_GET['user-action'] == 'search-user') {
        $searchQuery = $_POST['user-name'];
        $userList = userDB::getUsersForSearch($searchQuery);
        require_once 'new-conversation.php';
    }
    else if(isset ($_GET['user-action']) && $_GET['user-action'] == 'new-conversation' && isset($_GET['user-id'])) {
        $userList = [];
        $userList[] = userDB::getUserById($_GET['user-id']);
        require_once 'new-conversation.php';
    }
    else if(isset ($_GET['user-action']) && $_GET['user-action'] == 'new-conversation') {
        require_once 'new-conversation.php';
    }
    else {
        $messages = Messaging::getMessagesBySenderReceiver(1,$_GET['user-id']);
        require_once 'messaging.php';
    }

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
                  document.getElementById("msg-ajax").innerHTML=xmlhttp.responseText;
                }
            }

            var url = "messaging-ajax.php?user-id=<?=$_GET['user-id']?>";
            xmlhttp.open("GET",url,true);
            xmlhttp.send();
            
        },5000);
    });

</script>
