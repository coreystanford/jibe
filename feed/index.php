	<?php 
    require_once '../model/database.php';
    include '../model/category.php';
	include '../model/user.php';
	include '../model/project.php';
    require_once '../model/projectDB.php';
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

            $projects = ProjectDB::getProjects();

            if(count($projects) < 1){
                include 'nofeed.php';
            } else {
                include 'feed.php';
            }

        break;
        case 'other':

            include 'feed.php';

        break;
    }