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
                    $row['cat_id'], 
                    $row['cat_title'],
                    $row['cat_description'],
                    $row['cat_icon']);
            $user = new User(
                    $row['fname'],
                    $row['lname'],
                    $row['city'],
                    $row['country'],
                    $row['website'],
                    $row['img_url'],
                    $row['bio'],
                    $row['specialty'],
                    $row['email']
                    );
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
    
//    public static function getJobByCategory($job_id){
//        $db = Database::getDB();
//        $query = "SELECT * FROM job_board JOIN category ON job_board.cat_id = category.cat_id WHERE job_board.job_id = :jid";
//        $stm = $db->prepare($query);
//        $stm->bindParam(':jid', $job_id, PDO::PARAM_INT);
//        $stm->execute();
//        $result = $stm->fetchAll(PDO::FETCH_ASSOC);        
//        //var_dump($result);
//        $projects = array();
//        
//        foreach ($result as $row) {
//            $author = new Author(
//                    $row['author_id'], 
//                    $row['author_name'],
//                    $row['author_email'],
//                    $row['author_location']);
//            $project = new Project(
//                    $author, 
//                    $row['project_title'],
//                    $row['project_mainimg'],
//                    $row['project_date'],
//                    $row['project_summary']);
//            $project->setID($row['project_id']);
//            $projects[] = $project;
//        }
//        return $projects;
//    }
    
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
                    $row['cat_id'], 
                    $row['cat_title'],
                    $row['cat_description'],
                    $row['cat_icon']);
            $user = new User(
                    $row['fname'],
                    $row['lname'],
                    $row['city'],
                    $row['country'],
                    $row['website'],
                    $row['img_url'],
                    $row['bio'],
                    $row['specialty'],
                    $row['email']
                    );
            $job_listing = new Job(
                    $user,
                    $category, 
                    $row['job_title'],
                    $row['job_description'],
                    $row['job_company'],
                    $row['logo_url'],
                    $row['job_city'],
                    $row['job_country'],
                    $row['job_date']);
            $job_listing->setID($row['job_id']);
            
            //$job_listing = array("category" => $category, "user" => $user, "job" => $job);

        return $job_listing;
    }
    
    public static function deleteJob($job_id){
        $db = Database::getDB();
        $query = "DELETE FROM job_board WHERE job_id = :id";
        $stm = $db->prepare($query);
        $stm->bindParam(':id', $job_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        return $row_count;
    }
    
//    public static function addJob($job){
//        $db = Database::getDB();
//        $user_id = $job->getUser()->getID();
//        $cat_id = $job->getCategory()->getID();
//        $fname = $job->fname;
//        $lname = $job->lname;
//        
//        $query = "INSERT INTO job_board
//                    (user_id,
//                    cat_id,
//                    job_title,
//                    job_description,
//                    job_company,
//                    logo_url,
//                    job_city,
//                    job_country,
//                    job_date) 
//                    VALUES(
//                        '$author_id',
//                        '$title',
//                        '$mainimg',
//                        '$date',
//                        '$summary')";
//        $stm = $db->prepare($query);
//        $row_count = $stm->execute();
//        return $row_count;
//                         
//    }
    
    
}
