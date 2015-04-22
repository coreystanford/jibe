<?php 

	require '../model/autoload.php';

	if (!isset($_SESSION)){
        session_start();
    }
    if(!HomepageDB::isLoggedIn()){
        header("Location: ../");
        die();
    }
	if(isset($_SESSION['user_id'])){
	    $SESSION_ID = $_SESSION['user_id'];
	}

	$followed = $_POST['id'];
	$follower = $SESSION_ID;

	FollowDB::followUser($followed, $follower);

?>