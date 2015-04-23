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

    // ------------------------------ //
    // ------ Setup Validation ------ //
    // ------------------------------ //

    $textValidate = new Validate;
    $textfields = $textValidate->getFields();
    $textfields->addField('main');
    $textfields->addField('sub');
    $textfields->addField('btn-text');
    $textfields->addField('btn-link');

    $imgValidate = new Validate;
    $imgfields = $imgValidate->getFields();
    $imgfields->addField('main-img');

	// ---------------------------- //
    // ------ Perform Switch ------ //
    // ---------------------------- //

    switch ($action){
        
        // -------------------------- //
        // ------ Show Default ------ //
        // -------------------------- //

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

        // ------------------------- //
        // ------ TEXT FIELDS ------ //
        // ------------------------- //

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

    			$textValidate->text('main', $main);
                $textValidate->text('sub', $sub);
    			$textValidate->text('btn-text', $btn_text, true, 1, 15);
                $textValidate->url('btn-link', $btn_link);

    			if($textfields->hasErrors()){

    				$home = HomepageDB::getHomeInfo();
                	$projects = HomepageDB::getFeatured();
                    $img = $home['main_img_url'];

                    include 'text-edit.php';
    	            include 'image.php';
    	            include 'projects.php';

                } else {

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

            	}

            break;

        // ------------------------ //
        // ------ MAIN IMAGE ------ //
        // ------------------------ //

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

                $home = HomepageDB::getHomeInfo();
                $projects = HomepageDB::getFeatured();
                
                $main = $home['main_text'];
                $sub = $home['sub_text'];
                $btn_text = $home['button_text'];
                $btn_link = $home['button_link'];
                $img = $home['main_img_url'];

                $imgValidate->upload('main-img', $_FILES['main-img']);

                if($imgfields->hasErrors()){
                    
                    include 'text.php';
                    include 'image-edit.php';
                    include 'projects.php';

                } else { 

                    $fileupload = new FileUpload;
                    $fileupload->setTarget('../../images_upload/');
                    $fileupload->setFilename($_FILES['main-img']['name']);
                    $fileupload->uploadFile($_FILES['main-img']);

                    $img = $_FILES['main-img']['name'];
                    HomepageDB::updateImage($img);

                    include 'text.php';
                    include 'image.php';
                    include 'projects.php';

                }

            break;

        // ---------------------- //
        // ------ PROJECTS ------ //
        // ---------------------- //

            // ------ Show Unfeatured Projects ------ //

            case 'unfeatured':

                $feed = FeedDB::getLimitAndLoads();
                $limit = $feed['feed_limit'];
                $loads = $feed['feed_loads'];

                include 'unfeatured.php';

            break;

            // ------ Add a Featured Project ------ //

            case 'add-project':
            	
            	$id = $_POST['id'];
                HomepageDB::addFeature($id);

                $feed = FeedDB::getLimitAndLoads();
                $limit = $feed['feed_limit'];
                $loads = $feed['feed_loads'];

                include 'unfeatured.php';

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

	