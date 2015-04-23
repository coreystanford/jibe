<?php
//require '../config.php';
//require '../errors/errorhandler.php';
//require '../model/autoload.php';
//
//
//session_start();

// current user id
    
if(isset($_GET['id'])){
            $user_id = $_GET['id'];       
}
elseif(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
     
} else {
            $user_id = 1;
        }
        

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_stats';
}


switch ($action){

    case 'list_stats':
        $stats_projects = ViewDB::getUsersProjects($user_id); //list projects by user_id.
        $user = UserDB::getUserById($user_id); //get user information
        
        include 'list_stats.php';
        break;

    case 'delete_comment' :
        $message_success = '';
        $message_fail = '';
        $proj_id_sel = '';

        if(isset($_POST['comment_id'])){
        if(CommentDB::deleteComment($_POST['comment_id']) == 1){
            $message_success = "comment deleted";
        }
        else{
            $message_fail = "error deleting comment";
        }
        }
        $user_id = $_POST['user_id'];
        $proj_id_sel = $_POST['proj_id'];
        $stats_projects = ViewDB::getUsersProjects($user_id); //list projects by user_id.
        $user = UserDB::getUserById($user_id); //get user information
        
        include 'list_stats.php';
        break;
}