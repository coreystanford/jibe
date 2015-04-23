<?php

    require '../model/autoload.php';

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
    
	// ---------------------------- //
    // ------ Perform Switch ------ //
    // ---------------------------- //

    switch ($action){
        
        // ------ Show Default ------ //

        case 'default':

            header('Location: ./homepage/');

        break;
	
	}