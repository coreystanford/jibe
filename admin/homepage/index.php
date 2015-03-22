<?php

	require_once '../../model/database.php';
	require_once '../../model/fields.php';
	require_once '../../model/validate.php';
	require_once '../../model/homepageDB.php';
	require_once '../../model/category.php';
	require_once '../../model/user.php';
	require_once '../../model/project.php';
	require_once '../../model/projectDB.php';

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

            include 'text.php';
            include 'image.php';
            include 'projects.php';

        break;

        // ------ Show Text Update ------ //

        case 'text-edit':

            $home = HomepageDB::getHomeInfo();
            $projects = HomepageDB::getFeatured();

            $main = $home['main_text'];
            $sub = $home['sub_text'];
            $btn_text = $home['button_text'];
            $btn_link = $home['button_link'];
            $img = $home['main_img_url'];

            include 'text-edit.php';
            include 'image.php';
            include 'projects.php';

        break;

        // ------ Perform Text Update ------ //

        case 'text-update':

        	$main = $_POST['main'];
            $sub = $_POST['sub'];
            $btn_text = $_POST['btn-text'];
            $btn_link = $_POST['btn-link'];

			//$updValidate->text('updtitle', $title);
            //$updValidate->text('upddesc', $desc, true, 1, 500);
			//$updValidate->text('updicon', $icon, true, 1, 200);

			//if($updfields->hasErrors()){

				//$home = HomepageDB::getHomeInfo();
            	//$projects = HomepageDB::getFeatured();

                //include 'text-edit.php';
	            //include 'image.php';
	            //include 'projects.php';

            //} else {

	        	$text = ["main_text" => $main,
                         "sub_text" => $sub,
                         "button_text" => $btn_text,
                         "button_link" => $btn_link];

	            HomepageDB::updateText($text);

	            $home = HomepageDB::getHomeInfo();
            	$projects = HomepageDB::getFeatured();

                $main = $home['main_text'];
                $sub = $home['sub_text'];
                $btn_text = $home['button_text'];
                $btn_link = $home['button_link'];
                $img = $home['main_img_url'];

	            include 'text.php';
	            include 'image.php';
	            include 'projects.php';

        	//}

        break;

        // ------ Show Image Update ------ //

        case 'image-edit':
        	
            $home = HomepageDB::getHomeInfo();
            $projects = HomepageDB::getFeatured();

            $main = $home['main_text'];
            $sub = $home['sub_text'];
            $btn_text = $home['button_text'];
            $btn_link = $home['button_link'];
            $img = $home['main_img_url'];

            include 'text.php';
            include 'image-edit.php';
            include 'projects.php';

        break;

        // ------ Perform Image Update ------ //

        case 'image-update':
        	
        	
			$img = $_POST['main-img'];

			//$imgValidate->text('updtitle', $title);

			//if($updfields->hasErrors()){

				//$home = HomepageDB::getHomeInfo();
            	//$projects = HomepageDB::getFeatured();

                //include 'text.php';
	            //include 'image-edit.php';
	            //include 'projects.php';

            //} else {

	            HomepageDB::updateImage($img);

	            $home = HomepageDB::getHomeInfo();
            	$projects = HomepageDB::getFeatured();
	            
                $main = $home['main_text'];
                $sub = $home['sub_text'];
                $btn_text = $home['button_text'];
                $btn_link = $home['button_link'];
                $img = $home['main_img_url'];
                
	            include 'text.php';
	            include 'image.php';
	            include 'projects.php';

        	//}

        break;

        // ------ Show Unfeatured Projects ------ //

        case 'unfeatured':

            $projects = HomepageDB::getUnfeatured();

            include 'unfeatured.php';

        break;

        // ------ Add a Featured Project ------ //

        case 'add-project':
        	
        	$id = $_POST['id'];
            HomepageDB::addFeature($id);

            $projects = HomepageDB::getUnfeatured();
            include 'unfeatured.php';

            //$home = HomepageDB::getHomeInfo();
            //$projects = HomepageDB::getFeatured();
//
            //$main = $home['main_text'];
            //$sub = $home['sub_text'];
            //$btn_text = $home['button_text'];
            //$btn_link = $home['button_link'];
            //$img = $home['main_img_url'];
//
            //include 'text.php';
            //include 'image.php';
            //include 'projects.php';

        break;

        // ------ Remove a Featured Project ------ //

        case 'remove-project':
        	
        	$id = $_POST['id'];
            HomepageDB::removeFeature($id);

            $home = HomepageDB::getHomeInfo();
            $projects = HomepageDB::getFeatured();

            $main = $home['main_text'];
            $sub = $home['sub_text'];
            $btn_text = $home['button_text'];
            $btn_link = $home['button_link'];
            $img = $home['main_img_url'];

            include 'text.php';
            include 'image.php';
            include 'projects.php';

        break;

	}

	