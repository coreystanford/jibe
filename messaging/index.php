<?php
/*    
    Author: Wilston Dsouza
    This file is the contoller for the messaing system
*/
    require '../model/autoload.php';
    
    //Start session
    if (!isset($_SESSION)){
        session_start();
    }

    //If not logged in, redirect user to login page
    if(!HomepageDB::isLoggedIn()){
        header("Location: ../");
        die();
    }
    
    require_once '../model/database.php';
    require_once '../model/message.php';
    require_once '../model/user.php';
    require_once '../model/messagingDB.php';
    require_once '../model/userDB.php';

    $this_user_id = $_SESSION['user_id'];
    
    //Get conversations for the user
    $users = Messaging::getConversationsByUser($this_user_id);

    $messages;

    if(!isset($_GET['user-action']) && !isset($_POST['user-action'])) {
        if(!empty($users)) {
            $messages = Messaging::getMessagesBySenderReceiver($this_user_id,$users[0]->getID());
            require_once 'messaging.php';
        }
        else {
            require_once 'new-conversation.php';
        }
        
    }
    else if(isset ($_POST['user-action']) && $_POST['user-action'] == 'add-msg') {
        $message = new Message($this_user_id, $_GET['user-id'], $_POST['msg-txt']);
        Messaging::addMessage($message);
        $messages = Messaging::getMessagesBySenderReceiver($this_user_id,$_GET['user-id']);
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
        $messages = Messaging::getMessagesBySenderReceiver($this_user_id,$_GET['user-id']);
        require_once 'messaging.php';
    }

?>
<!-- 
    Script with AJAX call to refresh message window. 
    Causes conflict if included from external. 
    Hence used here.
-->
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
            
        },3000);
    });

</script>
