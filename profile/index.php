<?php

	require_once '../model/database.php';
	require_once '../model/fields.php';
	require_once '../model/validate.php';
	require_once '../model/category.php';
	require_once '../model/user.php';
    require_once '../model/userDB.php';
	require_once '../model/project.php';
	require_once '../model/projectDB.php';

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
    // ------ Get Session ID ------ //
    // ---------------------------- //

        //$id = $_SESSION['id'];
        $SESSION_ID = 1;

        if(isset($_GET['id'])){
            $GET_ID = $_GET['id'];
        } else {
            $GET_ID = 1;
        }
        

	// ---------------------------- //
    // ------ Perform Switch ------ //
    // ---------------------------- //

    switch ($action){
        
        // ------ Show Default ------ //

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

            if($GET_ID == $SESSION_ID){
                include 'slider.php';
                include 'user-info.php';
                include 'tabs.php';
            } else {
                include 'view-user.php';
            }

        break;

        // ------ Show User Info Update ------ //

        case 'user-edit':

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

            include 'slider.php';
            include 'user-edit.php';
            include 'tabs.php';

        break;

        // ------ Perform User Info Update ------ //

        case 'user-update':

            $id = $_POST['id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $website = $_POST['website'];
            $pro_img = $_POST['pro_img'];
            $bio = $_POST['bio'];
            $specialty = $_POST['specialty'];

			$updValidate->text('updtitle', $title);
            $updValidate->text('upddesc', $desc, true, 1, 500);
			$updValidate->text('updicon', $icon, true, 1, 200);

			if($updfields->hasErrors()){

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

                include 'slider.php';
                include 'user-edit.php';
                include 'tabs.php';

            } else {

                //$user = new User($fname, $lname, $city = '', $country = '', $website = '', $img_url = '', $bio = '', $specialty = '');
	            //userDB::updateUser($user);

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

                include 'slider.php';
                include 'user-info.php';
                include 'tabs.php';

        	}

        break;

        // ------ Edit a Featured Project ------ //

        case 'edit-project':

            //$project = ProjectDB...;

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

            include 'slider.php';
            include 'user-info.php';
            include 'tabs.php';

        break;

	}

	