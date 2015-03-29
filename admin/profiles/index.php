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

            $reports = ReportDB::getResolvedReports();
            $sum = getList($reports);

            include 'profiles.php';

        break;
	
	}