<?php

	require_once '../../model/database.php';
	require_once '../../model/fields.php';
	require_once '../../model/validate.php';
	require_once '../../model/homepageDB.php';
	require_once '../../model/category.php';
	require_once '../../model/user.php';
	require_once '../../model/project.php';
	require_once '../../model/projectDB.php';

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


	// ---------------------------- //
    // ------ Perform Switch ------ //
    // ---------------------------- //

    switch ($action){
        
        // ------ Show Default ------ //

        case 'default':

        	$home = HomepageDB::getHomeInfo();
        	$projects = ProjectDB::getProjects();

            include 'text.php';
            include 'image.php';
            include 'projects.php';

        break;

        // ------ Show Text Update ------ //

        case 'text-edit':
        	
			$id = $_GET['id'];

            $home = CategoryDB::getHomeInfo();
            $projects = ProjectDB::getProjects();

            $title = $category->getTitle();
            $desc = $category->getDesc();
            $icon = $category->getIcon();

            include 'text-edit.php';
            include 'image.php';
            include 'projects.php';

        break;

        // ------ Perform Text Update ------ //

        case 'text-update':
        	
        	$cat_id = $_POST['id'];
        	$title = $_POST['updtitle']; 
			$desc = $_POST['upddesc'];
			$icon = $_POST['updicon'];

			$updValidate->text('updtitle', $title);
            $updValidate->text('upddesc', $desc, true, 1, 500);
			$updValidate->text('updicon', $icon, true, 1, 200);

			if($updfields->hasErrors()){

				$home = CategoryDB::getHomeInfo();
            	$projects = ProjectDB::getProjects();

                include 'text-edit.php';
	            include 'image.php';
	            include 'projects.php';

            } else {

	        	$category = new Category($title, $desc, $icon);
	            CategoryDB::updateCategory($category, $cat_id);

	            $home = CategoryDB::getHomeInfo();
            	$projects = ProjectDB::getProjects();

	            include 'text.php';
	            include 'image.php';
	            include 'projects.php';

        	}

        break;

        // ------ Show Image Update ------ //

        case 'img-edit':
        	
			$id = $_GET['id'];
            $home = CategoryDB::getHomeInfo();
            $projects = ProjectDB::getProjects();

            $title = $category->getTitle();
            $desc = $category->getDesc();
            $icon = $category->getIcon();

            include 'text.php';
            include 'image-edit.php';
            include 'projects.php';

        break;

        // ------ Perform Image Update ------ //

        case 'img-update':
        	
        	$cat_id = $_POST['id'];
        	$title = $_POST['updtitle']; 
			$desc = $_POST['upddesc'];
			$icon = $_POST['updicon'];

			$imgValidate->text('updtitle', $title);

			if($updfields->hasErrors()){

				$home = CategoryDB::getHomeInfo();
            	$projects = ProjectDB::getProjects();

                include 'text.php';
	            include 'image-edit.php';
	            include 'projects.php';

            } else {

	        	$category = new Category($title, $desc, $icon);
	            CategoryDB::updateCategory($category, $cat_id);

	            $$home = CategoryDB::getHomeInfo();
            	$projects = ProjectDB::getProjects();
	            
	            include 'text.php';
	            include 'image.php';
	            include 'projects.php';

        	}

        break;

        // ------ Show Unfeatured Projects ------ //

        case 'unfeatured':
        	
        	$id = $_POST['id'];
            CategoryDB::deleteCategory($id);

            $home = CategoryDB::getHomeInfo();
            $projects = ProjectDB::getProjects();

            include 'unfeatured.php';

        break;

        // ------ Add a Featured Project ------ //

        case 'add-project':
        	
        	$id = $_POST['id'];
            CategoryDB::addFeature($id);

            $home = CategoryDB::getHomeInfo();
            $projects = ProjectDB::getProjects();

            include 'text.php';
            include 'image.php';
            include 'projects.php';

        break;

        // ------ Remove a Featured Project ------ //

        case 'remove-project':
        	
        	$id = $_POST['id'];
            CategoryDB::removeFeature($id);

            $home = CategoryDB::getHomeInfo();
            $projects = ProjectDB::getProjects();

            include 'text.php';
            include 'image.php';
            include 'projects.php';

        break;

	}

	