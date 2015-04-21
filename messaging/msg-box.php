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