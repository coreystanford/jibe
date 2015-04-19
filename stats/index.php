<?php
require '../config.php';
require '../errors/errorhandler.php';
require '../model/autoload.php';


session_start();

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
        
        include 'list_stats.php';
        break;

    case 'delete_comment' :
        
        break;
}