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
        //var_dump($_GET);
        if(isset($_GET['id'])){
            $GET_ID = $_GET['id'];
        }

    // ------------------------------ //
    // ------ Setup Validation ------ //
    // ------------------------------ //

    $textValidate = new Validate;
    $textfields = $textValidate->getFields();
    $textfields->addField('fname');
    $textfields->addField('lname');
    $textfields->addField('city');
    $textfields->addField('country');
    $textfields->addField('website');
    $textfields->addField('bio');
    $textfields->addField('specialty');

    $imgValidate = new Validate;
    $imgfields = $imgValidate->getFields();
    $imgfields->addField('pro_thumb');

	// ---------------------------- //
    // ------ Perform Switch ------ //
    // ---------------------------- //

    switch ($action){
        
        // -------------------------- //
        // ------ Show Default ------ //
        // -------------------------- //

        case 'default':

        	$user = userDB::getUserById($GET_ID);
            $projects = ProjectDB::getProjectsByUserID($GET_ID);

            $id = $user->getID();
            $fname = $user->getFName();
            $lname = $user->getLName();
            $city = $user->getCity();
            $country = $user->getCountry();
            $website = $user->getWebsite();
            $pro_img = $user->getImgURL();
            $bio = $user->getBio();
            $specialty = $user->getSpecialty();
            
            var_dump("get: ".$GET_ID."  session: ".$SESSION_ID);
           
            if(!isset($_GET) || $GET_ID == $SESSION_ID){
                include 'slider.php';
                include 'user-info.php';
                include 'tabs.php';
            } else {
                include 'view-user.php';
            }

        break;

        // ------------------------------ //
        // ------ Show User Update ------ //
        // ------------------------------ //

        case 'user-edit':

            $user = userDB::getUserById($SESSION_ID);
            $projects = ProjectDB::getProjectsByUserID($SESSION_ID);

            $id = $user->getID();
            $fname = $user->getFName();
            $lname = $user->getLName();
            $city = $user->getCity();
            $country = $user->getCountry();
            $website = $user->getWebsite();
            $pro_img = $user->getImgURL();
            $bio = $user->getBio();
            $specialty = $user->getSpecialty();

            include 'slider.php';
            include 'user-edit.php';
            include 'tabs.php';

        break;

        // --------------------------------- //
        // ------ Perform User Update ------ //
        // --------------------------------- //

        case 'user-update':

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $website = $_POST['website'];
            $bio = $_POST['bio'];
            $specialty = $_POST['specialty'];

            $textValidate->text('fname', $fname, true, 1, 50);
            $textValidate->text('lname', $lname, true, 1, 50);
            $textValidate->text('city', $city, false, 1, 50);
            $textValidate->text('country', $country, false, 1, 50);
            $textValidate->text('website', $website, false, 1, 60);
            $textValidate->text('bio', $bio, false, 1, 220);
            $textValidate->text('specialty', $specialty, false, 1, 100);

			if($textfields->hasErrors()){

				$user = userDB::getUserById($GET_ID);
                $projects = ProjectDB::getProjectsByUserID($GET_ID);

                $pro_img = $user->getImgURL();

                include 'slider.php';
                include 'user-edit.php';
                include 'tabs.php';

            } else {

                $user = new User($fname, $lname, $city, $country, $website, null, $bio, $specialty);
	            userDB::updateUser($user, $SESSION_ID);

	            $user = userDB::getUserById($SESSION_ID);
                $projects = ProjectDB::getProjectsByUserID($SESSION_ID);

                $id = $user->getID();
                $fname = $user->getFName();
                $lname = $user->getLName();
                $city = $user->getCity();
                $country = $user->getCountry();
                $website = $user->getWebsite();
                $pro_img = $user->getImgURL();
                $bio = $user->getBio();
                $specialty = $user->getSpecialty();

                include 'slider.php';
                include 'user-info.php';
                include 'tabs.php';

        	}

        break;

        // ---------------------------------- //
        // ------ Update Profile Image ------ //
        // ---------------------------------- //

        case 'img-update':

            
            $projects = ProjectDB::getProjectsByUserID($SESSION_ID);

            $imgValidate->upload('pro_thumb', $_FILES['pro_thumb']);

            if($imgfields->hasErrors()){
                
                $user = userDB::getUserById($SESSION_ID);
                $id = $user->getID();
                $fname = $user->getFName();
                $lname = $user->getLName();
                $city = $user->getCity();
                $country = $user->getCountry();
                $website = $user->getWebsite();
                $pro_img = $user->getImgURL();
                $bio = $user->getBio();
                $specialty = $user->getSpecialty();

                include 'slider.php';
                include 'user-info.php';
                include 'tabs.php'; 
                include '../errors/img-error-modal.php';

            } else {

                $fileupload = new FileUpload;
                $fileupload->setFilename($_FILES['pro_thumb']['name']);
                $fileupload->uploadFile($_FILES['pro_thumb']);
                $fileupload->createNewProfileThumbs($_FILES['pro_thumb']['name']);
                $fileupload->deleteFile($_FILES['pro_thumb']);

                $img = $fileupload->getFilename();
                userDB::updateImagePath($SESSION_ID, $img);

                $user = userDB::getUserById($SESSION_ID);
                $id = $user->getID();
                $fname = $user->getFName();
                $lname = $user->getLName();
                $city = $user->getCity();
                $country = $user->getCountry();
                $website = $user->getWebsite();
                $pro_img = $user->getImgURL();
                $bio = $user->getBio();
                $specialty = $user->getSpecialty();

                include 'slider.php';
                include 'user-info.php';
                include 'tabs.php';

            }

        break;

        // ---------------------------------- //
        // ------ Delete Profile Image ------ //
        // ---------------------------------- //

        case 'img-delete':

            $user_id = $_POST['user_id'];
            $img = $_POST['img'];

            $imgname = explode("/", $img);

            // do not delete the image if it is the profile default
            if($imgname[3] != 'default.jpg'){
                $fileupload = new FileUpload;
                $fileupload->deleteFile($img);
                userDB::deleteImagePath($user_id);
            }

            $user = userDB::getUserById($user_id);
            $projects = ProjectDB::getProjectsByUserID($SESSION_ID);

            $id = $user->getID();
            $fname = $user->getFName();
            $lname = $user->getLName();
            $city = $user->getCity();
            $country = $user->getCountry();
            $website = $user->getWebsite();
            $pro_img = $user->getImgURL();
            $bio = $user->getBio();
            $specialty = $user->getSpecialty();

            include 'slider.php';
            include 'user-info.php';
            include 'tabs.php'; 

        break;

        // --------------------------- //
        // ------ Profile Setup ------ //
        // --------------------------- //

        case 'setup':

            

        break;

        // ---------------------------------- //
        // ------ Submit Profile Setup ------ //
        // ---------------------------------- //

        case 'submit-setup':

            

        break;

	}

	