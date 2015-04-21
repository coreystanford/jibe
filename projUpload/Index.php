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
        $uFields->addField('proj_title');
        $uFields->addField('proj_description');
        $uFields->addField('upfile');
        
        
    // ------ START SWITCH  ------ //
    
        switch ($action){     
            
    // ------ Show Default ------ //        
          
        case 'openUpload';
            require 'projectUpload.php';
            
        break;
   
   // ------ validate project upload form ------ //   
            
        case 'validateProject';
    
            $uValidate->proj_title('proj_title', $proj_title);
            $uValidate->proj_description('proj_description', $proj_description);
            $uValidate->upfile('upfile', $upfile);
      
            if($uFields->hasErrors()){
                
                include 'projectUpload.php';
                
            }else{

                //new instance of file upload class
                $fileupload = new FileUpload;
                $fileupload->setFilename($_FILES['upfile']['name']);
                $fileupload->uploadFile($_FILES['upfile']);
                
                $fileupload->deleteFile($_FILES['pro_thumb']);
                
                
                $img = $fileupload->getFilename();
                FileUpload::updateImagePath($SESSION_ID, $img);
              
                
                
                
                header('Location: ../profile/');
                
            }
            
            
           break; 
       
    
    
  
            
    // ------ Upload Success! -End Switch------ //
            
    
        }