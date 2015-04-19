<?php
require '../config.php';
require '../errors/errorhandler.php';
require '../model/autoload.php';


if(isset($_SESSION['id'])){
	    $SESSION_ID = $_SESSION['id'];
	} else {
	    $SESSION_ID = 1;
	}
        
if(isset($_GET['id'])){
           $GET_ID = $_GET['id'];
       } else {
           $GET_ID = 1;
        }

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_stats';
}
$user_id = $GET_ID;
     //$user_id = $id;   
switch ($action){

    case 'list_stats':
        $stats_projects = ViewDB::getUsersProjects($user_id); //list projects by user_id.
        
        include 'list_stats.php';
        break;

    case 'delete_comment' :
        
        break;
}