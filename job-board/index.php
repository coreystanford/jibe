<?php
require('../model/database_il.php');
require('../model/category.php');
require('../model/categoryDB.php');
require('../model/user.php');
require('../model/userDB.php');
require('../model/job.php');
require('../model/jobDB.php');

$cities = JobDB::getCitiesList();
$countries = JobDB::getCountriesList();
$categories = JobDB::getCategoriesWithJobs();

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

    include('job_list.php');
} else if ($action == 'view_job') {
   // $categories = CategoryDB::getCategories();
    $job_id = $_GET['job_id'];
    $job_listing = JobDB::getJobById($job_id);
    //echo $job_listing['job']->getJobTitle();
    //var_dump($job_listing);
    include('job_view.php');
} else if ($action == 'add_job') {
    
    $allcategories = CategoryDB::getCategories();
    $user_id = 1;
    $job_title = '';
    $job_description = '';
    $job_city = '';
    $job_country = '';
    $job_logo = '';
    $job_company = '';
    $job_date = date('Y-m-d');
       $now_date = new DateTime();
    $job_date = $now_date->format('Y-m-d H:i:s');
    $job_cat = '';
    
    
    if(isset($_POST['submitjob'])) {
            
    //job_add input validation goes here
        $user_id = $_POST['user_id'];
        $job_date = $_POST['job_date'];
        $job_cat = $_POST['job_cat'];
        $job_title = $_POST['job_title'];
        $job_description = $_POST['job_description'];
        $job_city = $_POST['job_city'];
        $job_country = $_POST['job_country'];
        $job_logo = $_POST['job_logo'];
        $job_company = $_POST['job_company'];
    
        include('job_posted.php');
    }
    elseif(isset($_POST['resetjob'])) {
        
        include('job_add.php');
    }
    else {
        
        include('job_add.php');

    }
    
    
    
    
    
    
}

?>