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
	    $action = 'openUpload';
	}
    // ------ Project Upload Validation ------ //
        
        $uValidate = new Validate;
        $uFields = $uValidate->getFields();
        $uFields->addField('invalid');
        $uFields->addField('proj_title');
        $uFields->addField('proj_description');
        $uFields->addField('upfile');
        
        
    // ------ START SWITCH  ------ //
    
        switch ($action){
            
            
    // ------ Show Default ------ //        
        
            
        case 'openUpload';
            
            
        break;
    
    
   // ------ Validate Upload ------ //
            
        case 'upload';
            
            
       break;
            
            
    // ------ Upload Success! ------ //
            
            
            
            
        }