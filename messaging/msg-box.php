<?php
    if(!isset($_GET['id'])) {
        $id = $users[0]->getID();
    }
    else {
        $id = $_GET['id'];
    }
?>

<div class="clear-fix line-space"></div>

<div id="msg-box">
    <form action="?action=add-msg&id=<?= $id ?>" method="post">
        <textarea name="msg-txt"></textarea>
        <input type="submit" value="send" name="msg-form" id="send-btn">
    </form>
</div>