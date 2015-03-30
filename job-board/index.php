<?php
require '../config.php';


//require(MODEL_PATH . 'database.php');
//require(MODEL_PATH . 'category.php');
//require(MODEL_PATH . 'categoryDB.php');
//require(MODEL_PATH . 'user.php');
//require(MODEL_PATH . 'userDB.php');
//require(MODEL_PATH . 'job.php');
//require(MODEL_PATH . 'jobDB.php');
//require(MODEL_PATH . 'fileupload.php');

require(MODEL_PATH . 'autoload.php');


$cities = JobDB::getCitiesList();
$countries = JobDB::getCountriesList();
$categories = JobDB::getCategoriesWithJobs();

$message_success = '';
$message_fail = '';

if (isset($_POST['action']) && (!empty($_POST['action']))) {
    $action = $_POST['action'];
} else if (isset($_GET['action']) && (!empty($_GET['action']))) {
    $action = $_GET['action'];
} else {
    $action = 'list_jobs';
}

$jobs = JobDB::getJobs();

switch($action) {
    case 'list_jobs' :
        $job_cat = '';
        $job_city = '';
        $job_country = '';

        if(!isset($_POST['submitfilter'])) {
            $jobs = JobDB::getJobs();
        }
        elseif(isset($_POST['resetfilter'])) {
            $jobs = JobDB::getJobs();
        }
        else
        {
            $job_cat = $_POST['categories'];
            $job_city = $_POST['cities'];
            $job_country = $_POST['countries'];
            $jobs = JobDB::getJobByFilter($job_cat, $job_city, $job_country);
        }

        include('job_list.php');    
    break;
    
    case 'view_job' :

        // $categories = CategoryDB::getCategories();
        if(isset($_GET['job_id'])){
            $job_id = $_GET['job_id'];
            $job_listing = JobDB::getJobById($job_id);
            if($job_listing->getID() == NULL) {
                $message_fail = "Job not found";
                include('job_list.php');
            } else {
                include('job_view.php');
            } //if job is found
        } else {
            $message_fail = "Error identifying the job to edit. Please select a job from the list";
            include('job_list.php');
        }
        break;

    default : include('job_list.php');
        break;
}
?>