<?php

$root_path = $_SERVER['DOCUMENT_ROOT']."/5202/jibe/";
$css_path = $root_path."css/";
$admin_path = $root_path."admin/";
$model_path = $root_path."model/";


require($model_path . 'database_il.php');
require($model_path . 'category.php');
require($model_path . 'categoryDB.php');
require($model_path . 'user.php');
require($model_path . 'userDB.php');
require($model_path . 'job.php');
require($model_path . 'jobDB.php');
require($model_path . 'file_upload.php');

   
// current user id
$user_id = 1;
$message_success = '';
$message_fail = '';

$current_user = userDB::getUserById($user_id);
$allcategories = CategoryDB::getCategories();
$jobs = JobDB::getJobs($user_id);

$menu = array (
    "List Jobs" => "?action=list_jobs",
    "Add New Listing" => "?action=add_job"
    );

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_jobs';
}

switch ($action){

case 'edit_job' :
   // $categories = CategoryDB::getCategories();
    $menu_links = array();
    if(isset($_GET['job_id'])){
        $job_id = $_GET['job_id'];
    } elseif (isset($_POST['job_id'])){
        $job_id = $_POST['job_id'];
    }
    
    if(!empty($job_id)){
        $job_listing = JobDB::getJobById($job_id);
        if($job_listing->getID() == NULL) {
            $message_fail = "Job not found";
            include('myjob_list.php');
        } else {
        //job_add input validation goes here
            $job_date = $job_listing->getJobDate();
            $job_cat = $job_listing->getJobCategory()->getID();
            $job_title = $job_listing->getJobTitle();
            $job_description = $job_listing->getJobDescription();
            $job_city = $job_listing->getJobCity();
            $job_country = $job_listing->getJobCountry();
            $job_company = $job_listing->getJobCompany();
            $job_logo = $job_listing->getLogoUrl();

            if(!isset($_POST['submitjob'])) {
                include('myjob_edit.php');   
                   

            } // if update form is submitted
            
            elseif(isset($_POST['resetjob'])){
                $jobs = JobDB::getJobs($user_id);
                include('myjob_list.php');                  
            } // if reset form is submitted
            
            else {         
                include('_update_job.php');

                $jobs = JobDB::getJobs($user_id);
                include('myjob_list.php');    
            } // if update form is submitted
        } // if job was found    
    } // if job_id is not empty
    else {
        $message_fail = "Error idetifying the job to edit. Please select a job from the list";
        include('myjob_list.php');
    }
    break;
        
case 'delete_job' :
        $job_id = $_POST['job_id'];
    
        if (JobDB::deleteJob($job_id) != 1) {
            echo "error";
        } else {
            echo "Success!";
        }
    
        $jobs = JobDB::getJobs($user_id);
        include('myjob_list.php');
    break;
    
case 'add_job' :
    
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

            include ('_add_job.php');
            $jobs = JobDB::getJobs($user_id);
            include('myjob_list.php');    

        } //if new job form is submitted
    
        else {
         
            include('job_add.php');

        }
    break;
    
default  :
        include('myjob_list.php');
    break;

    
} //switch
?>