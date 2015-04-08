<?php

    require './config.php';
    require './errors/errorhandler.php';
    require './model/autoload.php';

 	// -------------------------------------- //
    // -=------ Determine Current Action ------ //
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

    $lValidate = new Validate;
    $lFields = $lValidate->getFields();
    $lFields->addField('invalid');
    $lFields->addField('email');
    $lFields->addField('password');

    $rValidate = new Validate;
    $rFields = $rValidate->getFields();
    $rFields->addField('email');
    $rFields->addField('password');
    $rFields->addField('confirmPassword');
        
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
	
      // ------ Validate Login ------ //
    
        case 'login':

            session_start();

            $username = trim($_POST['email']);
            $password = trim($_POST['password']);

            $lFields->getField('invalid')->clearErrorMessage();
            $lValidate->email('email', $email);
            $lValidate->password('password', $password);

            if($lFields->hasErrors()){

                include 'login.php';

            } else {

                $result = HomepageDB::userLogin($email);

                if($result < 1){

                    $lFields->getField('invalid')->setErrorMessage('Invalid email or password');
                    include 'login.php';
                    die();

                } else {

                  
                    $hash = $result['password'];

                    if(password_verify($password, $hash)) {

                        $userid = $result['id'];
                        setSession($userid);
                        include 'secure-page.php';

                    } else {

                        $lFields->getField('invalid')->setErrorMessage('Invalid email or password');
                        include 'login.php';
                        die();

                    }

                }

            }

        break;

       // ------ Show Registration ------ //

        case 'register':

            include 'register.php';

        break;

        // ------ Validate Registration ------ //

        case 'new_user':

            if(isset($_POST['submit'])){
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $confirmPassword = trim($_POST['confirmPassword']);
            }

            $rValidate->email('email', $email);
            $rValidate->password('password', $password);
            $rValidate->confirmPassword('confirmPassword', $password, $confirmPassword);

            if($rFields->hasErrors()){

                include 'register.php';

            } else {

                $hash = password_hash($password, PASSWORD_BCRYPT);

                HomepageDB::userRegister($email, $hash);

                include 'registered.php';

            }

        break;

        // ------ Logout ------ //

        case 'logout':

            logout();
            include 'logout.php';

        break;

    }

        
        