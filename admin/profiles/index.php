<?php

	require '../../config.php';
    require '../../errors/errorhandler.php';
    require '../../model/autoload.php';

 	// -------------------------------------- //
    // ------ Determine Current Action ------ //
    // -------------------------------------- //

    // ------ POST ------ //

    if (isset($_POST['action'])) {
	    $action = $_POST['action'];
	} 

	// ------ GET ------ //

	else if (isset($_GET['action'])) {
	    $action = $_GET['action'];
	} 

	// ------ DEFAULT ------ //

	else {
	    $action = 'default';
	}

    // --------------------- //
    // ------ SESSION ------ //
    // --------------------- //

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

	// ---------------------------- //
    // ------ Perform Switch ------ //
    // ---------------------------- //

    switch ($action){
        
        // ------ Show Default ------ //

        case 'default':

        	$profiles = userDB::getUsers();
            
            include 'profiles.php';

        break;

        // ------ Show Delete ------ //

        case 'delete-user':
            
            $id = $_GET['id'];
            $reported = userDB::getUserById($id);

            include 'delete-user.php';

        break;

        // ------ Perform Delete ------ //

        case 'confirm-delete-user':
            
            $id = $_POST['id'];
            userDB::deleteUser($id);

            $profiles = userDB::getUsers();

            include 'profiles.php';

        break;
	
	}