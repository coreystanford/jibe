	<?php 
    require_once '../model/database.php';
    include '../model/category.php';
	include '../model/user.php';
	include '../model/project.php';
    require_once '../model/exploreDB.php';
    include '../model/functions.php';

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


	switch ($action){
        
        // ------ Show Default ------ //

        case 'default':

            $projects = Explore::getProjects();
            include 'explore.php';

        break;
        case 'other':

            include 'explore.php';

        break;
    }