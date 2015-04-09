<?php
include './view/header.php'; 
session_start();

$_SESSION['email']  = $email;
$_SESSION['password'] = $password;
$_SESSION['user_id'] = $userID;

//include './model/log.php';

//	if (!isset($_SESSION)){
//		session_start();
//	}
//
//	if(!isLoggedIn()){
//	    header('Location: .');
//	    die();
//	}
//
//	
//
//?>

<h1>This is the secure page.</h1>
<h2>You're Logged In!</h2>

<a href=".?action=logout" >Logout</a>

<?php include './view/footer.php'; ?>
 
?>


