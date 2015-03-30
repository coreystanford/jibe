<?php

	require '../../config.php';
    require '../../errors/errorhandler.php';
    require '../../model/autoload.php';

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

	// ------------------------------ //
    // ------ Setup Validation ------ //
    // ------------------------------ //

	$Validate = new Validate;
    $fields = $Validate->getFields();
    $fields->addField('title');
    $fields->addField('desc');
    $fields->addField('icon');

	// ---------------------------- //
    // ------ Perform Switch ------ //
    // ---------------------------- //

    switch ($action){
        
        // -------------------------- //
        // ------ Show Default ------ //
        // -------------------------- //

            case 'default':

            	$categories = CategoryDB::getCategoriesWithCount();
                include 'categories.php';

            break;

        // -------------------- //
        // ------ INSERT ------ //
        // -------------------- //
	
            // ------ Show Insert ------ //

            case 'insert':
            	
                include 'insert.php';

            break;

            // ------ Perform Insert ------ //

            case 'commit-insert':
            	
            	$title = $_POST['title']; 
    			$desc = $_POST['desc'];
    			$icon = $_POST['icon'];

                $Validate->text('title', $title, true, 1, 50);
                $Validate->text('desc', $desc, true, 1, 500);
    			$Validate->text('icon', $icon, true, 1, 200);

    			if($fields->hasErrors()){

                    include 'insert.php';

                } else {

    	        	$category = new Category($title, $desc, $icon);
    	            CategoryDB::insertCategory($category);
    	            
    	            $categories = CategoryDB::getCategoriesWithCount();
    	            include 'categories.php';

            	}

            break;

        // -------------------- //
        // ------ UDPATE ------ //
        // -------------------- //

            // ------ Show Update ------ //

            case 'edit':
            	
    			$id = $_GET['id'];
                $category = CategoryDB::getCategoryByID($id);

                $title = $category->getTitle();
                $desc = $category->getDesc();
                $icon = $category->getIcon();

                include 'edit.php';

            break;

            // ------ Perform Update ------ //

            case 'update':
            	
            	$cat_id = $_POST['id'];
            	$title = $_POST['title'];
    			$desc = $_POST['desc'];
    			$icon = $_POST['icon'];

    			$Validate->text('title', $title);
                $Validate->text('desc', $desc, true, 1, 500);
    			$Validate->text('icon', $icon, true, 1, 200);

    			if($fields->hasErrors()){

                    include 'edit.php';

                } else {

    	        	$category = new Category($title, $desc, $icon);
    	            CategoryDB::updateCategory($category, $cat_id);

    	            $categories = CategoryDB::getCategoriesWithCount();
    	            include 'categories.php';

            	}

            break;

        // -------------------- //
        // ------ DELETE ------ //
        // -------------------- //

            // ------ Show Delete ------ //

            case 'delete':
            	
            	$id = $_GET['id'];
                $category = CategoryDB::getCategoryByID($id);

                include 'delete.php';

            break;

            // ------ Perform Delete ------ //

            case 'confirmed-delete':
            	
            	$id = $_POST['id'];
                CategoryDB::deleteCategory($id);

                $categories = CategoryDB::getCategoriesWithCount();
                include 'categories.php';

            break;

	}