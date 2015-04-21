<?php 

	require '../model/autoload.php';

	if(isset($_SESSION['id'])){
	    $SESSION_ID = $_SESSION['id'];
	}

	$followed = $_POST['id'];
	$follower = $SESSION_ID;

	FollowDB::unfollowUser($followed, $follower);

?>