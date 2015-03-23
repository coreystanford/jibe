<?php

	require_once './model/database.php';
	require_once './model/fields.php';
	require_once './model/validate.php';
	require_once './model/category.php';
	require_once './model/user.php';
	require_once './model/project.php';
	require_once './model/homepageDB.php';

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

        	$home = HomepageDB::getHomeInfo();
        	$projects = HomepageDB::getFeatured();

        	$main = $home['main_text'];
        	$sub = $home['sub_text'];
        	$btn_text = $home['button_text'];
        	$btn_link = $home['button_link'];
        	$img = $home['main_img_url'];

            include 'home.php';

        break;
	
	}