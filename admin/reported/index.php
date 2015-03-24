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

            $reports = ReportDB::getUnresolvedReports();

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

        // ------ Show Resolved Reports ------ //

        case 'resolved':

            $reports = ReportDB::getResolvedReports();

            $sum = array();

            foreach($reports as $report){
                $rp = [
                "id" => $report->getID(),
                "reporter" => UserDB::getUserById($report->getReporter()),
                "reported" => ProjectDB::getProjectByID($report->getReportedProj())
                ];

                $sum[] = $rp;
            }

            include 'resolved-reports.php';

        break;

        // ------ Show Options ------ //

        case 'options':
        	
			$id = $_GET['id'];
            $report = ReportDB::getReportById($id);

            $reporter_id = $report->getReporter();
            $reported_id = $report->getReported();
            $project_id = $report->getReportedProj();

            $reporter = UserDB::getUserById($reporter_id);
            $project = ProjectDB::getProjectByID($project_id);
            $reported = $project->getUser();

            include 'options.php';

        break;

        // ------ Show Statistics ------ //

        case 'stats':

            $reported = ReportDB::getReported();

            $all_reported = array();

            foreach($reported as $report){
                $rp = [
                "reported" => UserDB::getUserById($report['reported']),
                "num" => $report['num_reported']
                ];

                $all_reported[] = $rp;
            }

            $reporters = ReportDB::getReporters();

            $all_reporters = array();

            foreach($reporters as $reporter){
                $rp = [
                "reporter" => UserDB::getUserById($reporter['reporter']),
                "num" => $reporter['num_reported']
                ];

                $all_reporters[] = $rp;
            }

            include 'stats.php';

        break;

        // ------ Resolve A Report ------ //

        case 'resolve':
            
            $id = $_GET['id'];
            ReportDB::resolveReport($id);

            $reports = ReportDB::getUnresolvedReports();

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

        // ------ Unresolve A Report ------ //

        case 'unresolve':
            
            $id = $_GET['id'];
            ReportDB::unresolveReport($id);

            $reports = ReportDB::getResolvedReports();

            $sum = array();

            foreach($reports as $report){
                $rp = [
                "id" => $report->getID(),
                "reporter" => UserDB::getUserById($report->getReporter()),
                "reported" => ProjectDB::getProjectByID($report->getReportedProj())
                ];

                $sum[] = $rp;
            }

            include 'resolved-reports.php';

        break;

        

        // ------ Show Delete ------ //

        case 'delete':
        	
        	$id = $_GET['id'];
            $report = ReportDB::getReportById($id);

            $reporter_id = $report->getReporter();
            $reported_id = $report->getReported();
            $project_id = $report->getReportedProj();

            $reporter = UserDB::getUserById($reporter_id);
            $project = ProjectDB::getProjectByID($project_id);
            $reported = $project->getUser();

            include 'delete.php';

        break;

        // ------ Perform Delete ------ //

        case 'confirmed-delete':
        	
        	$id = $_POST['id'];
            ReportDB::deleteReport($id);

            $reports = ReportDB::getResolvedReports();

            $sum = array();

            foreach($reports as $report){
                $rp = [
                "id" => $report->getID(),
                "reporter" => UserDB::getUserById($report->getReporter()),
                "reported" => ProjectDB::getProjectByID($report->getReportedProj())
                ];

                $sum[] = $rp;
            }

            include 'resolved-reports.php';

        break;

	}