<?php

	require_once '../../model/database.php';
	require_once '../../model/category.php';
	require_once '../../model/categoryDB.php';
	

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

        	$categories = CategoryDB::getCategories();

            include 'categories.php';

        break;
	
	}