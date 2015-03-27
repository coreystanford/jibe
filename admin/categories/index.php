<?php

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

	$insValidate = new Validate;
    $insfields = $insValidate->getFields();
    $insfields->addField('institle');
    $insfields->addField('insdesc');
    $insfields->addField('insicon');

    $updValidate = new Validate;
    $updfields = $updValidate->getFields();
    $updfields->addField('updtitle');
    $updfields->addField('upddesc');
    $updfields->addField('updicon');

	// ---------------------------- //
    // ------ Perform Switch ------ //
    // ---------------------------- //

    switch ($action){
        
        // ------ Show Default ------ //

        case 'default':

        	$categories = CategoryDB::getCategoriesWithCount();
            include 'categories.php';

        break;
	
        // ------ Show Insert ------ //

        case 'insert':
        	
            include 'insert.php';

        break;

        // ------ Perform Insert ------ //

        case 'commit-insert':
        	
        	$title = $_POST['institle']; 
			$desc = $_POST['insdesc'];
			$icon = $_POST['insicon'];

            $insValidate->text('institle', $title, true, 1, 50);
            $insValidate->text('insdesc', $desc, true, 1, 500);
			$insValidate->text('insicon', $icon, true, 1, 200);

			if($insfields->hasErrors()){

                include 'insert.php';

            } else {

	        	$category = new Category($title, $desc, $icon);
	            CategoryDB::insertCategory($category);
	            
	            $categories = CategoryDB::getCategoriesWithCount();
	            include 'categories.php';

        	}

        break;

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
        	$title = $_POST['updtitle']; 
			$desc = $_POST['upddesc'];
			$icon = $_POST['updicon'];

			$updValidate->text('updtitle', $title);
            $updValidate->text('upddesc', $desc, true, 1, 500);
			$updValidate->text('updicon', $icon, true, 1, 200);

			if($updfields->hasErrors()){

                include 'edit.php';

            } else {

	        	$category = new Category($title, $desc, $icon);
	            CategoryDB::updateCategory($category, $cat_id);

	            $categories = CategoryDB::getCategoriesWithCount();
	            include 'categories.php';

        	}

        break;

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