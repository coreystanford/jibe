<?php
require '../config.php';


    require '../errors/errorhandler.php';
    require '../model/autoload.php';

   
// current user id
session_start();
   if(isset($_GET['id'])){
            $user_id = $_GET['id'];       
}
elseif(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
     
} else {
            $user_id = 1;
        }


$message_success = '';
$message_fail = '';

$current_user = userDB::getUserById($user_id);
$allcategories = CategoryDB::getCategories();
$jobs = JobDB::getJobs($user_id);



if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_jobs';
}

    $newJobValidate = new Validate;
    $newjobfields = $newJobValidate->getFields();
    $newjobfields->addField('job_cat');
    $newjobfields->addField('job_title');
    $newjobfields->addField('job_company');
    $newjobfields->addField('job_city');
    $newjobfields->addField('job_country');
    $newjobfields->addField('job_description');

//    $updJobValidate = new Validate;
//    $updjobfields = $updJobValidate->getFields();
//    $updjobfields->addField('updtitle');
//    $updjobfields->addField('upddesc');
//    $updjobfields->addField('updicon');

switch ($action){

case 'edit_job' :
    if(isset($_GET['job_id'])){
        $job_id = $_GET['job_id'];
    } elseif (isset($_POST['job_id'])){
        $job_id = $_POST['job_id'];
    }
    
    if(!empty($job_id)){
        $anyerrors = '';
        $fileuploaderrors = '';

        $listing = JobDB::getJobById($job_id);
        if($listing->getID() == NULL) {
            $message_fail = "Job not found";
            include('list.php');
        } else {
            //if job exists in the database - pull job details for update
            $job_date = $listing->getJobDate();
            $job_cat = $listing->getJobCategory()->getID();
            $job_title = $listing->getJobTitle();
            $job_description = $listing->getJobDescription();
            $job_city = $listing->getJobCity();
            $job_country = $listing->getJobCountry();
            $job_company = $listing->getJobCompany();
            $job_logo = $listing->getLogoUrl();

            if(isset($_POST['submitjob'])) {
                //include('_update_job.php');
                $job_id = $_POST['job_id'];
                $user_id = $_POST['user_id'];
                $job_date = $_POST['job_date'];
                $job_cat = $_POST['job_cat'];
                $job_title = $_POST['job_title'];
                $job_description = $_POST['job_description'];
                $job_city = $_POST['job_city'];
                $job_country = $_POST['job_country'];
                $job_company = $_POST['job_company'];
                $job_logo = $_POST['job_logo'];
                
            $newJobValidate->lists('job_cat', $job_cat, "allcategories");
            $newJobValidate->text('job_title', $job_title, true, 1, 50);
            $newJobValidate->text('job_description', $job_description, true, 1, 2000);
            $newJobValidate->text('job_city', $job_city, true, 1, 50);
            $newJobValidate->lists('job_country', $job_country, "allcountries");
            $newJobValidate->text('job_company', $job_company, true, 1, 50);
         
            if(!$newjobfields->hasErrors()){

                //include 'edit.php';

            //} else {
                if (!empty($_FILES['upd_job_logo']['name'])) {

        //DO NOT DELETE TEMPFILENAME - USED TO CREATE A RANDOM NEW FILE NAME        
        //$tempfilename = basename($_FILES['job_logo']['tmp_name'], ".tmp");
        //$job_logo = $tempfilename . "." . pathinfo($_FILES['job_logo']['name'],PATHINFO_EXTENSION);
        // convert Job Title into file name - conversion function found here
        // http://www.zyxware.com/articles/3019/how-to-generate-filenames-from-a-given-string-by-replacing-spaces-and-special-characters-using-php-preg-replace   
        
                $upload_directory = '../images_upload/';

                $newfilename = "job_logo_" . strtolower(trim(preg_replace('#\W+#', '_', $job_company), '_'));
                $job_logo = $newfilename . "." . pathinfo($_FILES['upd_job_logo']['name'],PATHINFO_EXTENSION);
                $fileupload = new FileUpload;
                $fileupload->setTarget($upload_directory);
                //$filemanager->setExtensions(array('jpg'));
                //$fileupload->deleteFile($job_logo);
                $fileupload->setFilename($job_logo);
                echo $fileupload->displayErrors();
                $fileupload->uploadFile($_FILES['upd_job_logo']);
                $fileuploaderrors = $fileupload->_fm_error;
                
                $job_logo = "images_upload/" . $job_logo;
        
                if (!empty($fileuploaderrors)) {
                    //echo $fileuploaderrors; 
                    //include('edit.php'); 
                    $anyerrors .= $fileuploaderrors . "<br />";
                }
            }//if new logo is not empty 
            
                //else {

               
            //} // end if there are no fileupload errors    
                 
            }//if passed validation 
            else {
                $anyerrors .= "Form contains errors.";
            } //if form validation failed
            
            if (empty($anyerrors)){
                 $postedby = UserDB::getUserById($user_id);
                $category = CategoryDB::getCategoryById($job_cat);

                $new_job = new Job($postedby, $category, $job_title, $job_description, $job_company, $job_logo, $job_city, $job_country, $job_date);
                $new_job->setID($job_id);
                //var_dump($new_job);
                if (JobDB::updateJob($new_job, $job_id) != 1) {
                    $message_fail = 'There was an error updating this job listing';
                    $jobs = JobDB::getJobs($user_id);
                    include('list.php'); 
                } else {
                    $message_success = 'Job listing was updated successfully!';
                    $jobs = JobDB::getJobs($user_id);
                    header("Location:index.php");
                    //include('list.php');   
                }
            } else {
                echo $anyerrors;
                include('edit.php'); 
            }
            

            } //if update form is submitted
            
            elseif(isset($_POST['resetjob'])){
                $jobs = JobDB::getJobs($user_id);
                include('list.php');                  
            } // if reset form is submitted
            
            else {         
                include('edit.php'); 
            } // if update form is neither submitted nor reset
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
        $fileuploaderrors = '';

        if(isset($_POST['submitjob'])) {
            
            $user_id = $_POST['user_id'];
            $job_date = $_POST['job_date'];
            $job_cat = $_POST['job_cat'];
            $job_title = $_POST['job_title'];
            $job_description = $_POST['job_description'];
            $job_city = $_POST['job_city'];
            $job_country = $_POST['job_country'];
            $job_company = $_POST['job_company'];
        
        $newJobValidate->lists('job_cat', $job_cat, "allcategories");
        $newJobValidate->text('job_title', $job_title, true, 1, 50);
        $newJobValidate->text('job_description', $job_description, true, 1, 2000);
        $newJobValidate->text('job_city', $job_city, true, 1, 50);
        $newJobValidate->lists('job_country', $job_country, "allcountries");
        $newJobValidate->text('job_company', $job_company, true, 1, 50);

            if($newjobfields->hasErrors()){

                include 'add.php';

            } else {

                    
            //DO NOT DELETE TEMPFILENAME - USED TO CREATE A RANDOM NEW FILE NAME        
                //$tempfilename = basename($_FILES['job_logo']['tmp_name'], ".tmp");
                //$job_logo = $tempfilename . "." . pathinfo($_FILES['job_logo']['name'],PATHINFO_EXTENSION);
            // convert Job Title into file name - conversion function found here
            // http://www.zyxware.com/articles/3019/how-to-generate-filenames-from-a-given-string-by-replacing-spaces-and-special-characters-using-php-preg-replace   
                $upload_directory = "../images_upload/";

                $newfilename = "job_logo_" . strtolower(trim(preg_replace('#\W+#', '_', $job_company), '_'));
                $job_logo = $newfilename . "." . pathinfo($_FILES['job_logo']['name'],PATHINFO_EXTENSION);
                $fileupload = new FileUpload;
                $fileupload->setTarget($upload_directory);

                //$filemanager->setExtensions(array('jpg'));
                $fileupload->setFilename($job_logo);
                $fileupload->uploadFile($_FILES['job_logo']);
                $fileuploaderrors = $fileupload->displayErrors();

                if (!empty($fileuploaderrors)) { 
                    //$message_fail = $fileuploaderrors; 
                    include 'add.php';
                } else {
                    $postedby = UserDB::getUserById($user_id);
                    $category = CategoryDB::getCategoryById($job_cat);

                    $job_logo = "images_upload/" . $job_logo;
                    $new_job = new Job($postedby, $category, $job_title, $job_description, $job_company, $job_logo, $job_city, $job_country, $job_date);
                    if (JobDB::addJob($new_job) != 1) {
                        //$message_fail = "Failed to create new job";
                        include 'add.php';

                    } else {
                        $message_success = "New job created successfully!";
                        $jobs = JobDB::getJobs($user_id);
                        include('list.php');   
                    }
                }
            }//if passed validation
            

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