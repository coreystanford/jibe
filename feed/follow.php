<?php 

require '../model/database.php';
require '../model/follow.php';
require '../model/followDB.php';

if(isset($_SESSION['id'])){
    $SESSION_ID = $_SESSION['id'];
} else {
    $SESSION_ID = 1;
}

$followed = $_POST['id'];
$follower = $SESSION_ID;

FollowDB::followUser($followed, $follower);

?>