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
    if(isset($_SESSION['user_id'])){
        $SESSION_ID = $_SESSION['user_id'];
    }

    // ------------------------------------- //
    // ------ Setup Validation Fields ------ //
    // ------------------------------------- //

    $validate = new Validate;
    $fields = $validate->getFields();
    $fields->addField('limit');
    $fields->addField('loads');

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

            $validate->range('limit', $limit, 1, 50);
            $validate->range('loads', $loads, 1, 10);

            if(!$fields->hasErrors()){
                FeedDB::updateLimitAndLoads($limit, $loads);
            }

            include 'feed-info.php';

        break;
	
	}