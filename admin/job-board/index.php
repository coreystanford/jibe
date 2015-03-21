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
        $listing = JobDB::getJobById($job_id);
        if($listing->getID() == NULL) {
            $message_fail = "Job not found";
            include('list.php');
        } else {
        //add input validation goes here
            $job_date = $listing->getJobDate();
            $job_cat = $listing->getJobCategory()->getID();
            $job_title = $listing->getJobTitle();
            $job_description = $listing->getJobDescription();
            $job_city = $listing->getJobCity();
            $job_country = $listing->getJobCountry();
            $job_company = $listing->getJobCompany();
            $job_logo = $listing->getLogoUrl();

            if(!isset($_POST['submitjob'])) {
                include('edit.php');   
                   

            } // if update form is submitted
            
            elseif(isset($_POST['resetjob'])){
                $jobs = JobDB::getJobs($user_id);
                include('list.php');                  
            } // if reset form is submitted
            
            else {         
                include('_update_job.php');

                $jobs = JobDB::getJobs($user_id);
                include('list.php');    
            } // if update form is submitted
        } // if job was found    
    } // if job_id is not empty
    else {
        $message_fail = "Error identifying the job to edit. Please select a job from the list";
        include('list.php');
    }
    break;
        
case 'delete_job' :
    if(isset($_GET['job_id'])) {$job_id = $_GET['job_id'];}
    elseif (isset($_POST['job_id'])) {$job_id = $_POST['job_id'];}
    else {$job_id = NULL;}
        if(!is_null($job_id)){
    
            if (JobDB::deleteJob($job_id) != 1) {
                echo "error";
            } else {
                echo "Success!";
            }

            $jobs = JobDB::getJobs($user_id);
            header('Location: index.php');
            //include('list.php');
        } else {
        $message_fail = "Error identifying the job to delete. Please select a job from the list";
        include('list.php');
    }
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
            include('list.php');    

        } //if new job form is submitted
    
        else {
         
            include('add.php');

        }
    break;
    
default  :
        include('list.php');
    break;

    
} //switch
?>