<?php

    session_start();

    require_once '../model/database.php';
    require_once '../model/message.php';
    require_once '../model/user.php';
    require_once '../model/messagingDB.php';

    $this_user_id = $_SESSION['user_id'];
    
    $users = Messaging::getConversationsByUser($this_user_id);

    $messages;

    $messages = Messaging::getMessagesBySenderReceiver($this_user_id,$_GET['user-id']);
    
?>

<!--<div id="msg-ajax">-->
    <div id="msg-sidebar">
        <ul>
            <?php
                if(isset($users)) {
                    foreach ($users as $user) {
                        echo '<li><a href="?user-action=view&user-id='.$user->getID().'">'. $user->getFName() . ' ' . $user->getLName() . '</a></li>';
                    }
                }
            ?>
            <li class="new-conv-btn"><a href="?user-action=new-conversation">New Conversation</a></li>
        </ul>
    </div>
    <div id="msg-content">
        <ul>
            <?php
                if(isset($messages)) {
                    foreach($messages as $message) {
                        if($message->user_sender == $this_user_id) {
                                echo '<li class="msg-me">' . $message->message . '<br/><p class="time-sent">' . date_format(date_create($message->time_sent), 'G:i A \, jS F') . '</p></li>';
                            }
                            else {
                                echo '<li class="msg-you">' . $message->message . '<br/><p class="time-sent">' . date_format(date_create($message->time_sent), 'G:i A \, jS F') . '</p></li>';
                            }
                    }
                }
            ?>
        </ul>
    </div>
<!--</div>-->