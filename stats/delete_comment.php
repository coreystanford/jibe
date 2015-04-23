<?php
require '../config.php';
require '../errors/errorhandler.php';
require '../model/autoload.php';

//  function to process deleting comment through ajax call
session_start();
if(isset($_GET['id'])){
            $user_id = $_GET['id'];       
}
elseif(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
     
} else {
            $user_id = 1;
        }
        

// assign variables for success and failure messages
        
        $message_success = '';
        $message_fail = '';
        
// storing project from which comment is deleted so we can return message to that project
        
        $proj_id_sel = '';
        
// checking if the form was submitted 
        
        if(isset($_POST['comment_id'])){

        $user_id = $_POST['user_id'];
        $proj_id_sel = $_POST['proj_id'];
        
// committing update
        
           if(CommentDB::deleteComment($_POST['comment_id']) == 1){
           $message_success = "comment deleted";
        }
        else{
          $message_fail = "error deleting comment";
       }
       
        }
        else {echo "no form submitted";}
        
//   reload updated list of comments
        
        $stats_projects = ViewDB::getUsersProjects($user_id); //list projects by user_id.
        $user = UserDB::getUserById($user_id); //get user information
       
// call the view to display updated list of comments
        
        include 'list_stats.php';
        
