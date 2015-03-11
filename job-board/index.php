<?php
require('../model/database_il.php');
require('../model/category.php');
require('../model/user.php');
require('../model/job.php');
require('../model/jobDB.php');

$cities = JobDB::getCitiesList();
$countries = JobDB::getCountriesList();
$categories = JobDB::getCategoriesList();

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_jobs';
}

if ($action == 'list_jobs') {
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

    //$current_category = CategoryDB::getCategoryById($cat_id);
    //$categories = CategoryDB::getCategories();
    //$jobs = JobDB::getJobsByCategory($cat_id);
    //$jobs = JobDB::getJobs();

    include('job_list.php');
} else if ($action == 'view_job') {
   // $categories = CategoryDB::getCategories();
    $job_id = $_GET['job_id'];
    $job_listing = JobDB::getJobById($job_id);
    //echo $job_listing['job']->getJobTitle();
    //var_dump($job_listing);
    include('job_view.php');
}
?>