<?php
require '../config.php';
require '../errors/errorhandler.php';
require '../model/autoload.php';


session_start();
if(isset($_GET['id'])){
            $user_id = $_GET['id'];       
}
elseif(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
     
} else {
            $user_id = 1;
        }
        


        $message_success = '';
        $message_fail = '';
        $proj_id_sel = '';

        if(isset($_POST['comment_id'])){

        $user_id = $_POST['user_id'];
        $proj_id_sel = $_POST['proj_id'];
        
        //var_dump($_POST);
           if(CommentDB::deleteComment($_POST['comment_id']) == 1){
           $message_success = "comment deleted";
        }
        else{
          $message_fail = "error deleting comment";
       }
       
        }
        else {echo "no form";}
        $stats_projects = ViewDB::getUsersProjects($user_id); //list projects by user_id.
        $user = UserDB::getUserById($user_id); //get user information
       
        include 'list_stats.php';
        
