<?php


/**
 * Description of jobDB
 *
 * @author ILecoche
 */
class JobDB {
    
    public static function getJobs(){
        $db = Database::getDB();
        $query = "SELECT * FROM job_board "
                . "JOIN category ON job_board.cat_id = category.cat_id "
                . "JOIN users ON job_board.user_id = users.user_id "
                . "JOIN user_info ON users.user_id = user_info.user_id";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $jobs = array();
        
        foreach ($result as $row) {
            $category = new Category(
                    $row['cat_title'],
                    $row['cat_description'],
                    $row['cat_icon']);
            $category->setID($row['cat_id']);
            $user = new User(
                    $row['fname'],
                    $row['lname'],
                    $row['city'],
                    $row['country'],
                    $row['website'],
                    $row['img_url'],
                    $row['bio'],
                    $row['specialty']
                    );
            $user->setID($row['user_id']);
            $job = new Job(
                    $user,
                    $category, 
                    $row['job_title'],
                    $row['job_description'],
                    $row['job_company'],
                    $row['logo_url'],
                    $row['job_city'],
                    $row['job_country'],
                    $row['job_date']);
            $job->setID($row['job_id']);
            $jobs[] = $job;
        }
        return $jobs;
    }
    
    public static function getCitiesList(){
        $db = Database::getDB();
        $query = "SELECT DISTINCT job_city FROM job_board "
                . "ORDER BY job_city";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $cities = array();
                foreach ($result as $row) {
                    $cities[] = $row['job_city'];
                }

        return $cities;
        
    }
    
    public static function getCountriesList(){
        $db = Database::getDB();
        $query = "SELECT DISTINCT job_country FROM job_board "
                . "ORDER BY job_country";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $countries = array();
                foreach ($result as $row) {
                    $countries[] = $row['job_country'];
                }

    return $countries;
        
    }
    

    public static function getCategoriesWithJobs(){
        $db = Database::getDB();
        $query = "SELECT DISTINCT job_board.cat_id, cat_title FROM job_board "
                . "JOIN category ON job_board.cat_id = category.cat_id "
                . "ORDER BY cat_title";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $categories = array();
                foreach ($result as $row) {
                    $category = new Category($row['cat_title']);
                    $category->setID($row['cat_id']);
                    $categories[] = $category;
                }
        return $categories;
        
    }

    public static function getJobByFilter($cat, $city, $country){
        $db = Database::getDB();
        $query = "SELECT * FROM job_board "
                . "JOIN category ON job_board.cat_id = category.cat_id "
                . "JOIN users ON job_board.user_id = users.user_id "
                . "JOIN user_info ON users.user_id = user_info.user_id";        
        
        $filters = array();
        if($cat != "allcategories"){
            $filters[] = " job_board.cat_id = :cat";
        }
        
        if($city != "allcities"){
            $filters[] = " job_board.job_city = :city";
        }
        
        if($country != "allcountries"){
            $filters[] = " job_board.job_country = :country";
        }
        
        if(count($filters) > 0) { 
            $filter_str = implode(" AND", $filters); 
            $query .= " WHERE" . $filter_str;
        }
                
        $stm = $db->prepare($query);
    
        if($cat != "allcategories"){
            $stm->bindValue(':cat', $cat, PDO::PARAM_INT);
        }
        if($city != "allcities"){
            $stm->bindValue(':city', $city, PDO::PARAM_STR);
        }
        if($country != "allcountries"){
            $stm->bindValue(':country', $country, PDO::PARAM_STR);
        }

        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);        

        $jobs = array();
        
        foreach ($result as $row) {
            $category = new Category(
                    $row['cat_title'],
                    $row['cat_description'],
                    $row['cat_icon']);
            $category->setID($row['cat_id']);
            $user = new User(
                    $row['fname'],
                    $row['lname'],
                    $row['city'],
                    $row['country'],
                    $row['website'],
                    $row['img_url'],
                    $row['bio'],
                    $row['specialty']
                    );
            $user->setID($row['user_id']);
            //$user->setEmail($row['email']);
            $job = new Job(
                    $user,
                    $category, 
                    $row['job_title'],
                    $row['job_description'],
                    $row['job_company'],
                    $row['logo_url'],
                    $row['job_city'],
                    $row['job_country'],
                    $row['job_date']);
            $job->setID($row['job_id']);
            $jobs[] = $job;
        }
        return $jobs;
    }
    
    public static function getJobById($job_id){
        $db = Database::getDB();
       $query = "SELECT * FROM job_board "
                . "JOIN category ON job_board.cat_id = category.cat_id "
                . "JOIN users ON job_board.user_id = users.user_id "
                . "JOIN user_info ON users.user_id = user_info.user_id "
                . "WHERE job_id = :id";        
        $stm = $db->prepare($query);
        $stm->bindParam(':id', $job_id, PDO::PARAM_INT);
        $stm->execute();        
        $row = $stm->fetch(PDO::FETCH_ASSOC);
            $category = new Category(
                    $row['cat_title'],
                    $row['cat_description'],
                    $row['cat_icon']);
            $category->setID($row['cat_id']);
            $user = new User(
                    $row['fname'],
                    $row['lname'],
                    $row['city'],
                    $row['country'],
                    $row['website'],
                    $row['img_url'],
                    $row['bio'],
                    $row['specialty']
                    );
            $user->setID($row['user_id']);
            $job = new Job(
                    $user,
                    $category, 
                    $row['job_title'],
                    $row['job_description'],
                    $row['job_company'],
                    $row['logo_url'],
                    $row['job_city'],
                    $row['job_country'],
                    $row['job_date']);
            $job->setID($row['job_id']);
            
            //$job_listing = array("category" => $category, "user" => $user, "job" => $job);

        return $job;
    }
    
    public static function deleteJob($job_id){
        $db = Database::getDB();
        $query = "DELETE FROM job_board WHERE job_id = :id";
        $stm = $db->prepare($query);
        $stm->bindParam(':id', $job_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        return $row_count;
    }
    
    public static function addJob($job){
        $db = Database::getDB();
        $user_id = $job->getUser()->getID();
        $cat_id = $job->getJobCategory()->getID();
        $job_title = $job->getJobTitle();
        $job_description = $job->getJobDescription();
        $job_company = $job->getJobCompany();
        $logo_url = $job->getLogoUrl();
        $job_city = $job->getJobCity();
        $job_country = $job->getJobCountry();
        $job_date = $job->getJobDate();
       // $fname = $job->fname;
       // $lname = $job->lname;
        
        $query = "INSERT INTO job_board
                   (user_id,
                    cat_id,
                    job_title,
                    job_description,
                    job_company,
                    logo_url,
                    job_city,
                    job_country,
                    job_date) 
                    VALUES(
                        '$user_id',
                        '$cat_id',
                        '$job_title',
                        '$job_description',
                        '$job_company',
                        '$logo_url',
                        '$job_city',
                        '$job_country',
                        '$job_date'
                        )";
        $stm = $db->prepare($query);
        $row_count = $stm->execute();
        return $row_count;
                         
    }
    
    
}
