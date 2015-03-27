<?php

spl_autoload_register('ProjectDB::getProjects');
spl_autoload_register('ProjectDB::getProjectByID');
spl_autoload_register('ProjectDB::getProjectsByUserID');
spl_autoload_register('ProjectDB::getFeedProjects');
spl_autoload_register('ProjectDB::getExploreProjects');

class ProjectDB {
    
	public static function getProjects(){

        $db = Database::getDB();
        $query = "SELECT * FROM projects "
                . "JOIN category ON projects.cat_id = category.cat_id "
                . "JOIN users ON projects.user_id = users.user_id "
                . "JOIN user_info ON users.user_id = user_info.user_id";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        

	}

    public static function getProjectByID($proj_id){

        $db = Database::getDB();
        $query = "SELECT * FROM projects 
                JOIN category ON projects.cat_id = category.cat_id 
                JOIN users ON projects.user_id = users.user_id 
                WHERE proj_id = :proj_id ";
        $stm = $db->prepare($query);
        $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_STR);
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
                    $row['specialty']);
            $user->setID($row['user_id']);

            $project = new Project(
                    $user,
                    $category,
                    $row['proj_title'],
                    $row['proj_description'],
                    $row['proj_thumb'],
                    $row['proj_date'],
                    $row['featured']);
            $project->setID($row['proj_id']);

        return $project;
    }

    public static function getProjectsByUserID($user_id){

        $db = Database::getDB();
        $query = "SELECT * FROM projects 
                JOIN category ON projects.cat_id = category.cat_id 
                JOIN users ON projects.user_id = users.user_id 
                WHERE users.user_id = :user_id ";
        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $projects = array();

        foreach ($result as $row) {

            $category = new Category(
                    $row['cat_title'],
                    $row['cat_description'],
                    $row['cat_icon']);
            $category->setID($row['cat_id']);

            $project = new Project(
                    $row['user_id'],
                    $category,
                    $row['proj_title'],
                    $row['proj_description'],
                    $row['proj_thumb'],
                    $row['proj_date'],
                    $row['featured']);
            $project->setID($row['proj_id']);

            $projects[] = $project;

        }
        return $projects;

    }

    public static function getFeedProjects($user_id, $offset, $limit){

        $db = Database::getDB();

        $query = "SELECT * FROM projects 
                JOIN category ON projects.cat_id = category.cat_id 
                JOIN users ON projects.user_id = users.user_id 
                WHERE users.user_id IN (SELECT user_followed 
                                        FROM follow 
                                        WHERE user_follower = :user_id ) 
                LIMIT $offset, $limit";

        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return self::processProjects($result);

    }

    public static function getExploreProjects($user_id, $offset, $limit){

        $db = Database::getDB();

        $query = "SELECT * FROM projects 
                JOIN category ON projects.cat_id = category.cat_id 
                JOIN users ON projects.user_id = users.user_id 
                WHERE users.user_id NOT IN (SELECT user_followed 
                                        FROM follow 
                                        WHERE user_follower = :user_id ) 
                AND users.user_id != :user_id 
                LIMIT $offset, $limit";

        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return self::processProjects($result);

    }

    // ------ Helper - Process Projects ------ //

    private static function processProjects($result){

        $projects = array();

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
                    $row['specialty']);
            $user->setID($row['user_id']);

            $project = new Project(
                    $user,
                    $category,
                    $row['proj_title'],
                    $row['proj_description'],
                    $row['proj_thumb'],
                    $row['proj_date'],
                    $row['featured']);
            $project->setID($row['proj_id']);

            $projects[] = $project;

        }

        return $projects;
    }

}