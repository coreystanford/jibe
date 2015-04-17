<?php
    require '../config.php';
    require '../errors/errorhandler.php';
    require '../model/autoload.php';
    
    // -------------------------------------- //
    // ------ Determine Current Action ------ //
    // -------------------------------------- //
    
      if (isset($_POST['action'])) {
	    $action = $_POST['action'];
	} 

	// ------ GET ------ //

	else if (isset($_GET['action'])) {
	    $action = $_GET['action'];
	} 

	// ------ DEFAULT ------ //

	else {
	    $action = '';
	}
    // ------ Project Share Validation ------ //


        
        
    // ------ START SWITCH  ------ //
    
        switch ($action){     
           
        
    // ------ SHOW DEFAULT  ------ //
            
       case '';
           
           break;
            
            
            
            
    // ------ TWITTER SHARE ------ //
        case 'twitter';
            
            break;
    
        
        
    // ------ FACEBOOK SHARE ------ //
            
            
            
            
            
            
        }