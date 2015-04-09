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

    // ------------------------ //
    // ------ Session ID ------ //
    // ------------------------ //

        if(isset($_SESSION['user_id'])){
            $SESSION_ID = $_SESSION['user_id'];
        } else {
            $SESSION_ID = 1;
        }


	switch ($action){
        
        // ------ Show Default ------ //

        case 'default':

            $feed = FeedDB::getLimitAndLoads();

            $limit = $feed['feed_limit'];
            $loads = $feed['feed_loads'];

            include 'feed.php';

        break;

        // ------ Get the Limit and Loads ------ //

        case 'report':

            $feed = FeedDB::getLimitAndLoads();

            $limit = $feed['feed_limit'];
            $loads = $feed['feed_loads'];

            $reporter_id = $SESSION_ID;
            $reported_id = $_POST['reported_id'];
            $proj_id = $_POST['proj_id'];

            $report = new Report ($reporter_id, $reported_id, $proj_id);
            
            if(ReportDB::insertReport($report)){
                include 'feed.php';
                include 'reported-modal.php';
            } else {
                include 'feed.php';
                include '../errors/report-error-modal.php';
            }

        break;
    }