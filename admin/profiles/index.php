<?php

	require_once '../../model/database.php';
	require_once '../../model/category.php';
	require_once '../../model/project.php';
	require_once '../../model/projectDB.php';
	require_once '../../model/user.php';
	require_once '../../model/userDB.php';


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


	// ---------------------------- //
    // ------ Perform Switch ------ //
    // ---------------------------- //

    switch ($action){
        
        // ------ Show Default ------ //

        case 'default':

        	$profiles = userDB::getUsers();

            include 'profiles.php';

        break;
	
	}