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

    // ------------------------------ //
    // ------ Setup Validation ------ //
    // ------------------------------ //

    $textValidate = new Validate;
    $textfields = $textValidate->getFields();
    $textfields->addField('main');
    $textfields->addField('sub');
    $textfields->addField('btn-text');
    $textfields->addField('btn-link');

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

            $fileuploaderrors = "";

            if (!empty($_FILES['main-img'])) { 

                $fileupload = new FileUpload;
                $fileupload->setTarget('../../images_upload/');
                $fileupload->setFilename($_FILES['main-img']['name']);
                echo $fileupload->displayErrors();
                $fileupload->uploadFile($_FILES['main-img']);
                $fileuploaderrors = $fileupload->_fm_error;

            }

                if (empty($fileuploaderrors)) {

                    $img = $_FILES['main-img']['name'];
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

                } else {

                    $fileuploaderrors . "<br />";

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

                }

            

        break;

        // ------ Show Unfeatured Projects ------ //

        case 'unfeatured':

            include 'unfeatured.php';

        break;

        // ------ Add a Featured Project ------ //

        case 'add-project':
        	
        	$id = $_POST['id'];
            HomepageDB::addFeature($id);

            //$projects = HomepageDB::getUnfeatured();
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

	