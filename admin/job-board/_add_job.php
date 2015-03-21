<?php

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
        $upload_directory = "../../images_upload/";
        
        $newfilename = "job_logo_" . strtolower(trim(preg_replace('#\W+#', '_', $job_company), '_'));
        $job_logo = $newfilename . "." . pathinfo($_FILES['job_logo']['name'],PATHINFO_EXTENSION);
        $fileupload = new FileUpload;
        $fileupload->setTarget($upload_directory);
        
        //$filemanager->setExtensions(array('jpg'));
        $fileupload->setFilename($job_logo);
        $fileupload->uploadFile($_FILES['job_logo']);
        $errors = $fileupload->_fm_error;
        
    if (!empty($errors)) { echo $errors; }
    else {
        $postedby = UserDB::getUserById($user_id);
        $category = CategoryDB::getCategoryById($job_cat);
        
        $job_logo = "images_upload/" . $job_logo;
        $new_job = new Job($postedby, $category, $job_title, $job_description, $job_company, $job_logo, $job_city, $job_country, $job_date);
        if (JobDB::addJob($new_job) != 1) {
            echo "error";
        } else {
            echo "Success!";
        }
    }