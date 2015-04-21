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
        
        
        if (!isset($_SESSION)){
            session_start();
        }

        if(!HomepageDB::isLoggedIn()){
            header("Location: ../");
            die();
        }
        
        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
        }
        
        //var_dump($_SESSION);
        
        
        
    // ------ Project Upload Validation ------ //
        
        $uValidate = new Validate;
        $uFields = $uValidate->getFields();
        $uFields->addField('categories');
        $uFields->addField('proj_title');
        $uFields->addField('proj_description');
        $uFields->addField('proj_thumb');
        
        $iValidate = new Validate;
        $iFields = $iValidate->getFields();
        $iFields->addField('proj_attribute');
        $iFields->addField('proj_image');
        
        
    // ------ START SWITCH  ------ //
    
        switch ($action){     
            
    // ------ Show Default ------ //        
          
        case 'openUpload';
            
            $categoriesFromDB = CategoryDB::getCategories();

            $categories = array();
            foreach ($categoriesFromDB as $category) {
                $cat = $category->getTitle();
                $categories[] = $cat;
            }
            
            $title = "";
            $description = "";
            
            
            require 'projectUpload.php';
            
        break;
   
   // ------ validate project upload form ------ //   
            
        case 'validateProject';

            $categories = $_POST['categories'];
            $title = $_POST['proj_title'];
            $description = $_POST['proj_description'];
            
            $uValidate->lists('categories', $categories);
            $uValidate->text('proj_title', $title);
            $uValidate->text('proj_description', $description);
            $uValidate->upload('proj_thumb', $_FILES['proj_thumb']);
             
            if($uFields->hasErrors()){
                
                $categoriesFromDB = CategoryDB::getCategories();

                $categories = array();
                foreach ($categoriesFromDB as $category) {
                    $cat = $category->getTitle();
                    $categories[] = $cat;
                }
                
                include 'projectUpload.php';
                
            }else{

                $cat_id = CategoryDB::getCategoryIdFromString($categories);
                //var_dump("FILES: ".$_FILES['proj_thumb']['name']);
                
                $fileupload = new FileUpload;
                $fileupload->setFilename($_FILES['proj_thumb']['name']);
                $fileupload->uploadFile($_FILES['proj_thumb']);
                $fileupload->createProjectThumb($_FILES['proj_thumb']['name']);
                //$fileupload->deleteFile($_FILES['proj_thumb']);

                $thumb = $fileupload->getFilename();
                
                $project = new Project($user_id, $cat_id, $title, $description, $thumb);
                
                $max_proj_id = ProjectDB::insertProjectInfo($project);
                
                
                
                include 'contentUpdate.php';

            }

           break; 
          
            // ------ upload image to project ----- //
        case 'uploadImages';

            $max_proj_id = $_POST['max_proj_id'];
            $attribute = $_POST['proj_attribute'];
            $proj_image = $_FILES['proj_image'];

            $iValidate->text('proj_attribute', $attribute);
            $iValidate->upload('proj_image', $proj_image);

            
            if($iFields->hasErrors()){

                include 'contentUpdate.php';
                
            }else{

                $fileupload = new FileUpload;
                $fileupload->setTarget("../images_upload/projects/");
                $fileupload->setFilename($_FILES['proj_image']['name']);
                $fileupload->uploadFile($_FILES['proj_image']);

                $url = $fileupload->getFilename();
                
                $image = new File($url, $attribute);
                FileDB::insertImagesToProject($image, $max_proj_id);
                
                
                
                include 'projectUpload.php';
                
            }
            
            break;
           
           
           
    // ------ delete project ----- //
        case 'deleteProject';
           
           
           
            
            break;
    
        
        
     // ------ end switch ----- //
        
        }
        