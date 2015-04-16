<?php 
    
    require '../config.php';
    require '../errors/errorhandler.php';
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

    // -------------------------------- //
    // ------ Session ID + $_GET ------ //
    // -------------------------------- //

        if(isset($_SESSION['id'])){
            $SESSION_ID = $_SESSION['id'];
        } else {
            $SESSION_ID = 24;
        }


	switch ($action){
        
        // ------ Show Default ------ //

        case 'default':

            $feed = FeedDB::getLimitAndLoads();

            $limit = $feed['feed_limit'];
            $loads = $feed['feed_loads'];

            include 'explore.php';

        break;
        
        // ------ Report a Project/User ------ //

        case 'report':

            $feed = FeedDB::getLimitAndLoads();

            $limit = $feed['feed_limit'];
            $loads = $feed['feed_loads'];

            $reporter_id = $SESSION_ID;
            $reported_id = $_POST['reported_id'];
            $proj_id = $_POST['proj_id'];

            $report = new Report ($reporter_id, $reported_id, $proj_id);
            
            if(ReportDB::insertReport($report)){
                include 'explore.php';
                include 'reported-modal.php';
            } else {
                include 'explore.php';
                include '../errors/report-error-modal.php';
            }

        break;
    }


