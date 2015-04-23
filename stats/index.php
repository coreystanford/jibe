<?php

// current user id
    
if(isset($_GET['id'])){
            $user_id = $_GET['id'];       
}
elseif(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
     
} else {
            $user_id = 1;
        }
        
//  select all the projects by logged in user

        $stats_projects = ViewDB::getUsersProjects($user_id); //list projects by user_id.
        $user = UserDB::getUserById($user_id); //get user information
        
        include 'list_stats.php';
       