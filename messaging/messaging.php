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
                        echo '<li class="msg-me">' . $message->message . '</li>';
                    }
                    else {
                        echo '<li class="msg-you">' . $message->message . '</li>';
                    }
                    
                }
            
            ?>
            
        </ul>
    </div>
</div>

<?php require_once 'View/msg-box.php'; ?>

