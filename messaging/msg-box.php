<!--
    Author: Wilston Dsouza
    This is the text box and the send button for the messaging 
    feature. This has been put in a seperate file, as the rest of 
    the view gets refreshed every 3 seconds
-->

<?php
    if(!isset($_GET['user-id'])) {
        $id = $users[0]->getID();
    }
    else {
        $id = $_GET['user-id'];
    }
?>

<div class="clear-fix line-space"></div>

<div id="msg-box">
    <form action="?user-id=<?= $id ?>" method="post">
        <input type="hidden" name="user-action" value="add-msg">
        <textarea name="msg-txt"></textarea>
        <input type="submit" value="send" name="msg-form" id="send-btn">
    </form>
</div>