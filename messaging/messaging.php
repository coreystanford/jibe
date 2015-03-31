<?php include '../view/header.php'; ?>

<div id="msg-main">
    <div id="msg-ajax">
        <div id="msg-sidebar">
            <ul>

                <?php

                    foreach ($users as $user) {
                        echo '<li><a href="?action=view&id='.$user->getID().'">'. $user->getFName() . ' ' . $user->getLName() . '</a></li>';
                    }

                ?>

            </ul>
        </div>
        <div id="msg-content">
            <ul>

                <?php 

                    foreach($messages as $message) {

                        if($message->user_sender == 1) {
                            echo '<li class="msg-me">' . $message->message . '<br/><p class="time-sent">' . date_format(date_create($message->time_sent), 'G:i A \, jS F') . '</p></li>';
                        }
                        else {
                            echo '<li class="msg-you">' . $message->message . '<br/><p class="time-sent">' . date_format(date_create($message->time_sent), 'G:i A \, jS F') . '</p></li>';
                        }

                    }

                ?>

            </ul>
        </div>
    </div>
    
    <?php require_once 'msg-box.php'; ?>
    
</div>


<?php include '../view/footer.php'; ?>