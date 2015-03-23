<?php

	require_once '../../model/database.php';
	require_once '../../model/fields.php';
	require_once '../../model/validate.php';
	require_once '../../model/report.php';
	require_once '../../model/reportDB.php';
    require_once '../../model/user.php';
    require_once '../../model/userDB.php';
    require_once '../../model/category.php';
    require_once '../../model/project.php';
    require_once '../../model/content.php';
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

            $reports = ReportDB::getReports();

            $sum = array();

            foreach($reports as $report){
                $rp = [
                "id" => $report->getID(),
                "reporter" => UserDB::getUserById($report->getReporter()),
                "reported" => ProjectDB::getProjectByID($report->getReportedProj())
                ];

                $sum[] = $rp;
            }

            include 'reports.php';

        break;

        // ------ Show Update ------ //

        case 'edit':
        	
			$id = $_GET['id'];
            $report = ReportDB::getReportById($id);

            $reporter_id = $report->getReporter();
            $reported_id = $report->getReported();
            $project_id = $report->getReportedProj();

            $reporter = UserDB::getUserById($reporter_id);
            $project = ProjectDB::getProjectByID();
            $reported = $project->getUser();

            include 'edit.php';

        break;

        // ------ Show Reported Project ------ //

        case 'edit':
            
            $id = $_GET['id'];
            $report = ProjectDB::getProjectByID($id);



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

	            $categories = CategoryDB::getCategories();
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

            $categories = CategoryDB::getCategories();
            include 'categories.php';

        break;

	}