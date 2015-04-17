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
	    $action = 'register';
	}

   // ------ REGISTER Validation ------ //
    $rValidate = new Validate;
    $rFields = $rValidate->getFields();
    $rFields->addField('email');
    $rFields->addField('password');
    $rFields->addField('confirmPassword');
    $rFields->addField('fname');
    $rFields->addField('lname');
        
        

    switch ($action){
        
        
        
            // ------ Show Default ------ //
        
        
        
       // ------ Show Registration ------ //

        case 'register':

            $email = "";
            $password = "";
            $confirmPassword = "";
            $fname = "";
            $lname = "";
            
            include 'register.php';

        break;

        // ------ Validate Registration ------ //

        case 'new_user':

            $email = "";
            $password = "";
            $confirmPassword = "";
            $fname = "";
            $lname = "";
            
            if(isset($_POST['submit'])){
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $confirmPassword = trim($_POST['confirmPassword']);
                $fname = trim($_POST['fname']);
                $lname = trim($_POST['lname']);
            }
            
            $rValidate->email('email', $email);
            $rValidate->password('password', $password);
            $rValidate->confirmPassword('confirmPassword', $password, $confirmPassword);
            $rValidate->name('fname', $fname);
            $rValidate->name('lname', $lname);
            
            if($rFields->hasErrors()){
                
               include 'register.php';

            } else {

                $hash = password_hash($password, PASSWORD_BCRYPT);

                HomepageDB::userRegister($fname, $lname, $email, $hash);

                header("Location: ../profile/");

            }

        break;
        
           // ------ END SWICTH ------ //
        
        
    }

