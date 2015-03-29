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

	// ---------------------------- //
    // ------ Perform Switch ------ //
    // ---------------------------- //

    switch ($action){
        
        // ------ Show Default ------ //

        case 'default':

            $reports = ReportDB::getUnresolvedReports();
            $sum = getList($reports);

            include 'reports.php';

        break;

        // ------ Show Resolved Reports ------ //

        case 'resolved':

            $reports = ReportDB::getResolvedReports();
            $sum = getList($reports);

            include 'resolved-reports.php';

        break;

        // ------ Show Options ------ //

        case 'details':
        	
			$id = $_GET['id'];
            $report = ReportDB::getReportById($id);

            $reporter_id = $report->getReporter();
            $reported_id = $report->getReported();
            $project_id = $report->getReportedProj();

            $reporter = UserDB::getUserById($reporter_id);
            $project = ProjectDB::getProjectByID($project_id);
            $reported = $project->getUser();

            include 'details.php';

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
            $sum = getList($reports);

            include 'reports.php';

        break;

        // ------ Unresolve A Report ------ //

        case 'unresolve':
            
            $id = $_GET['id'];
            ReportDB::unresolveReport($id);

            $reports = ReportDB::getResolvedReports();
            $sum = getList($reports);

            include 'resolved-reports.php';

        break;

        

        // ------ Show Delete for Reports ------ //

        case 'delete-report':
        	
        	$id = $_GET['id'];
            $report = ReportDB::getReportById($id);

            $reporter_id = $report->getReporter();
            $reported_id = $report->getReported();
            $project_id = $report->getReportedProj();

            $reporter = UserDB::getUserById($reporter_id);
            $project = ProjectDB::getProjectByID($project_id);
            $reported = $project->getUser();

            include 'delete-report.php';

        break;

        // ------ Perform Delete for Reports ------ //

        case 'confirm-delete-report':
        	
        	$id = $_POST['id'];
            ReportDB::deleteReport($id);

            $reports = ReportDB::getResolvedReports();
            $sum = getList($reports);

            include 'resolved-reports.php';

        break;

        // ------ Show Delete for Projects ------ //

        case 'delete-project':
            
            $id = $_GET['id'];
            $project = ProjectDB::getProjectByID($id);

            include 'delete-project.php';

        break;

        // ------ Perform Delete for Projects ------ //

        case 'confirm-delete-project':
            
            $id = $_POST['id'];
            ProjectDB::deleteProject($id);

            $reports = ReportDB::getResolvedReports();
            $sum = getList($reports);

            include 'resolved-reports.php';

        break;

        // ------ Show Delete for Users ------ //

        case 'delete-user':
            
            $id = $_GET['id'];
            $reported = userDB::getUserById($id);

            include 'delete-user.php';

        break;

        // ------ Perform Delete for Users ------ //

        case 'confirm-delete-user':
            
            $id = $_POST['id'];
            userDB::deleteUser($id);

            $reports = ReportDB::getResolvedReports();
            $sum = getList($reports);

            include 'resolved-reports.php';

        break;

	}

    // ------ Helper Function - Get List of Reports ------ //

    function getList($reports){

        $sum = array();

            foreach($reports as $report){
                $rp = [
                "id" => $report->getID(),
                "reporter" => UserDB::getUserById($report->getReporter()),
                "reported" => ProjectDB::getProjectByID($report->getReportedProj())
                ];

                $sum[] = $rp;
            }

        return $sum;

    }

