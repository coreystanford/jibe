<?php include '../view/header.php'; ?>

<div id="msg-main">
    <div id="msg-ajax">
        <div id="msg-sidebar">
            <ul>

                <?php
                    if(isset($users)) {
                        foreach ($users as $user) {
                            echo '<li><a href="?user-action=view&user-id='.$user->getID().'">'. $user->getFName() . ' ' . $user->getLName() . '</a></li>';
                        }
                    }
                ?>
                <li><a href="?user-action=new-conversation">New Conversation</a></li>

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
    </div>
    
    <?php require_once 'msg-box.php'; ?>
    
</div>


<?php include '../view/footer.php'; ?>