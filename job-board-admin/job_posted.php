<?php

$postedby = UserDB::getUserById($user_id);
$category = CategoryDB::getCategoryById($job_cat);

$job_logo = $upload_directory . $job_logo;
$new_job = new Job($postedby, $category, $job_title, $job_description, $job_company, $job_logo, $job_city, $job_country, $job_date);
if (JobDB::addJob($new_job) != 1) {
    echo "error";
} else {
    echo "Success!";
}
    

    

    // var_dump($new_job);