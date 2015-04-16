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
	    $action = 'openlogin';
	}
    // ------ LOGIN Validation ------ //
    $lValidate = new Validate;
    $lFields = $lValidate->getFields();
    $lFields->addField('invalid');
    $lFields->addField('email');
    $lFields->addField('password');
    

      // ------ START SWITCH  ------ //
    
        switch ($action){
            
            
            
      // ------ Show Default ------ //
            
      case 'openlogin':
          
            $email = "";
            $password = "";
            
            include 'login.php';
            
        break;
            
      // ------ Validate Login ------ //
    
        case 'login':

            session_start($user_id);

            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $lFields->getField('invalid')->clearErrorMessage();
            $lValidate->email('email', $email);
            $lValidate->password('password', $password);

            if($lFields->hasErrors()){

                include 'login.php';

            } else {

                $result = HomepageDB::userLogin($email);

                if($result <= 1){

                    $lFields->getField('invalid')->setErrorMessage('Invalid email or password');
                    include '../login/login.php';
                    die();

                } else {

                    $hash = $result['password'];

                    if(password_verify($password, $hash)) {

                        $userid = $result['user_id'];
                        setSession($userid);

                        header("Location: ../feed/");

                    } else {

                        $lFields->getField('invalid')->setErrorMessage('Invalid email or password');
                        include 'login.php';
                        die();

                    }

                }

            }

        break;

        
      // ------ Logout ------ //

        case 'logout':

            HomepageDB::userLogout();
          
            header("Location: ../");
            

        break;


        
          // ------ END SWITCH ------ // 
        
        }