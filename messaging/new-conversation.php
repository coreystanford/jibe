<?php include '../view/header.php'; ?>

<div id="msg-main">
        <div id="msg-sidebar">
            <form action="?user-action=search-user" method="post">
<!--                <input type="hidden" name="user-action" id="user-action" value="search-user">-->
                <br/>
                <label>Search for user</label>
                <br/><br/>
                <input type="text" name="user-name" id="user-name">
                <br/><br/>
                <input type="submit" value="Search" id="search-btn">
            </form>
            <?php 
                if(isset($userList)) {
                    $listHtml = '<ul>';
                    foreach ($userList as $user) {
                        $listHtml .= '<li class="new-conv-btn"><a href="?user-action=new-conversation&user-id='.$user->getID().'">'. $user->getFName() . ' ' . $user->getLName() . '</a></li>';
                    }
                    $listHtml .= '</ul>';
                    echo $listHtml;
                }
            ?>
        </div>
        <div id="msg-content">
            
        </div>
    
    
    <div class="clear-fix line-space"></div>
    
    <?php
        if(isset($_GET['user-id'])) {
            $id = $_GET['user-id'];
        }
    ?>
    
    <div id="msg-box">
        <form action="?user-id=<?php if(!isset($id)) echo 'null'; else echo $id ?>" method="post">
            <input type="hidden" name="user-action" value="add-msg">
            <textarea name="msg-txt"></textarea>
            <input type="submit" value="send" name="msg-form" id="send-btn" <?php if(!isset($id)) echo 'disabled'; ?>>
        </form>
    </div>
    
</div>


<?php include '../view/footer.php'; ?>