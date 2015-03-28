<?php

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

        	$feed = FeedDB::getLimitAndLoads();

            $limit = $feed['feed_limit'];
            $loads = $feed['feed_loads'];

            include 'feed-info.php';

        break;

        // ------ Update Limit and Loads ------ //

        case 'update-feeds':
            
            $limit = $_POST['limit'];
            $loads = $_POST['loads'];

            FeedDB::updateLimitAndLoads($limit, $loads);

            include 'feed-info.php';

        break;
	
	}