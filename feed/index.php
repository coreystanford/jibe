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

    // ------------------------ //
    // ------ Session ID ------ //
    // ------------------------ //

        if(isset($_SESSION['id'])){
            $SESSION_ID = $_SESSION['id'];
        } else {
            $SESSION_ID = 1;
        }


	switch ($action){
        
        // ------ Show Default ------ //

        case 'default':

            //if(count($projects) < 1){
            //    include 'nofeed.php';
            //} else {
                include 'feed.php';
            //}

        break;

        // ------ Report a Project/User ------ //

        case 'report':

            $reporter_id = $SESSION_ID;
            $reported_id = $_POST['reported_id'];
            $proj_id = $_POST['proj_id'];

            $report = new Report ($reporter_id, $reported_id, $proj_id);
            
            ReportDB::insertReport($report);

            include 'reported.php';

        break;
    }