<?php

	require_once '../model/database.php';
	require_once '../model/fields.php';
	require_once '../model/validate.php';
	require_once '../model/category.php';
    require_once '../model/file_upload.php';
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

    // -------------------------------- //
    // ------ Session ID + $_GET ------ //
    // -------------------------------- //

        if(isset($_SESSION['id'])){
            $SESSION_ID = $_SESSION['id'];
        } else {
            $SESSION_ID = 1;
        }

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

        // ------ Perform User Info Update ------ //

        case 'user-update':

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $website = $_POST['website'];
            $bio = $_POST['bio'];
            $specialty = $_POST['specialty'];

			//$updValidate->text('updtitle', $title);
            //$updValidate->text('upddesc', $desc, true, 1, 500);
			//$updValidate->text('updicon', $icon, true, 1, 200);
//
			//if($updfields->hasErrors()){
//
			//	$user = userDB::getUserById($GET_ID);
            //    $projects = ProjectDB::getProjectsByUserID($GET_ID);
//
            //    $id = $user->getID();
            //    $fname = $user->getFName();
            //    $lname = $user->getLName();
            //    $city = $user->getCity();
            //    $country = $user->getCountry();
            //    $website = $user->getWebsite();
            //    $pro_img = $user->getImgURL();
            //    $bio = $user->getBio();
            //    $specialty = $user->getSpecialty();
//
            //    include 'slider.php';
            //    include 'user-edit.php';
            //    include 'tabs.php';
//
            //} else {

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

        	//}

        break;

        case 'img-update':

            if (!empty($_FILES['pro_thumb'])) {

                //DO NOT DELETE TEMPFILENAME - USED TO CREATE A RANDOM NEW FILE NAME        
                //$tempfilename = basename($_FILES['job_logo']['tmp_name'], ".tmp");
                //$job_logo = $tempfilename . "." . pathinfo($_FILES['job_logo']['name'],PATHINFO_EXTENSION); 
                // convert Job Title into file name - conversion function found here
                // http://www.zyxware.com/articles/3019/how-to-generate-filenames-from-a-given-string-by-replacing-spaces-and-special-characters-using-php-preg-replace   
        
                $upload_directory = '../../images_upload/';

                $newfilename = "job_logo_" . strtolower(trim(preg_replace('#\W+#', '_', $job_company), '_'));
                $job_logo = $newfilename . "." . pathinfo($_FILES['upd_job_logo']['name'],PATHINFO_EXTENSION);
                $fileupload = new FileUpload;
                $fileupload->setTarget($upload_directory);
                //$filemanager->setExtensions(array('jpg'));
                $fileupload->deleteFile($job_logo);
                $fileupload->setFilename($job_logo);
                echo $fileupload->displayErrors();
                $fileupload->uploadFile($_FILES['upd_job_logo']);
                $fileuploaderrors = $fileupload->_fm_error;
                
                $job_logo = "images_upload/" . $job_logo;
        
                if (!empty($fileuploaderrors)) {
                    $anyerrors .= $fileuploaderrors . "<br />";
                }

                ProjectDB::updateImagePath($SESSION_ID, $img);

            }

        break;

        case 'img-delete':



        break;

        // ------ Edit a Featured Project ------ //

        case 'edit-project':

            //$project = ProjectDB...;

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

        break;

	}

	