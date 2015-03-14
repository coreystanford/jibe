<?php
require('../model/database_il.php');
require('../model/category.php');
require('../model/categoryDB.php');
require('../model/user.php');
require('../model/userDB.php');
require('../model/job.php');
require('../model/jobDB.php');
require('../model/file_upload.php');

// current user id
$user_id = 1;

$current_user = userDB::getUserById($user_id);
//$cities = JobDB::getCitiesList();
//$countries = JobDB::getCountriesList();
$allcategories = CategoryDB::getCategories();

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_jobs';
}

if ($action == 'list_jobs') {
    $jobs = JobDB::getJobs($user_id);
    include('myjob_list.php');
} else if ($action == 'edit_job') {
   // $categories = CategoryDB::getCategories();
    $job_id = $_GET['job_id'];
    $job_listing = JobDB::getJobById($job_id);
    //echo $job_listing['job']->getJobTitle();
    //var_dump($job_listing);
    //job_add input validation goes here
        $job_date = $job_listing->getJobDate();
        $job_cat = $job_listing->getJobCategory()->getID();
        $job_title = $job_listing->getJobTitle();
        $job_description = $job_listing->getJobDescription();
        $job_city = $job_listing->getJobCity();
        $job_country = $job_listing->getJobCountry();
        $job_company = $job_listing->getJobCompany();
        $job_logo = $job_listing->getLogoUrl();
 
    include('myjob_edit.php');
    if(isset($_POST['submitjob'])) {
        $user_id = $_POST['user_id'];
        $job_date = $_POST['job_date'];
        $job_cat = $_POST['job_cat'];
        $job_title = $_POST['job_title'];
        $job_description = $_POST['job_description'];
        $job_city = $_POST['job_city'];
        $job_country = $_POST['job_country'];
        $job_company = $_POST['job_company'];
        $job_logo = $_POST['job_logo'];
        
        
    }

} else if ($action == 'delete_job') {
        $job_id = $_POST['job_id'];
    
        if (JobDB::deleteJob($job_id) != 1) {
            echo "error";
        } else {
            echo "Success!";
        }
    $jobs = JobDB::getJobs($user_id);
    include('myjob_list.php');    
} else if ($action == 'add_job') {
    
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
        $job_company = $_POST['job_company'];
 
        
    //DO NOT DELETE TEMPFILENAME - USED TO CREATE A RANDOM NEW FILE NAME        
        //$tempfilename = basename($_FILES['job_logo']['tmp_name'], ".tmp");
        //$job_logo = $tempfilename . "." . pathinfo($_FILES['job_logo']['name'],PATHINFO_EXTENSION);
    // convert Job Title into file name - conversion function found here
    // http://www.zyxware.com/articles/3019/how-to-generate-filenames-from-a-given-string-by-replacing-spaces-and-special-characters-using-php-preg-replace   
        
        $upload_directory = '../images_upload/';
        
        $newfilename = "job_logo_" . strtolower(trim(preg_replace('#\W+#', '_', $job_company), '_'));
        $job_logo = $newfilename . "." . pathinfo($_FILES['job_logo']['name'],PATHINFO_EXTENSION);
        $fileupload = new FileUpload;
        $fileupload->setTarget($upload_directory);
        
        //$filemanager->setExtensions(array('jpg'));
        $fileupload->setFilename($job_logo);
        $fileupload->uploadFile($_FILES['job_logo']);
        $errors = $fileupload->_fm_error;
        
    if (!empty($errors)) { echo $errors; }
    
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