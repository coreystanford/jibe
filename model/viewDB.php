<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of viewDB
 *
 * @author ILecoche
 */
class viewDB {
    
    
    
        
    // returns view by view id
    
    public static function getViewByViewId($view_id){
        $db = Database::getDB();
        $query = "SELECT num_views FROM views "
               . " WHERE view_id = :view_id";
        $stm = $db->prepare($query);
            $stm->bindParam(":view_id", $view_id, PDO::PARAM_INT);
            $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        
        return $row;
    }
    
    // returns view by project id
    
    public static function getViewByProjId($proj_id){
        $db = Database::getDB();
        $query = "SELECT * FROM views "
                . "WHERE views.proj_id = :proj_id";
        $stm = $db->prepare($query);
            $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
            $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        //$view = ViewDB::populateView($row);
        
        return $row;
    }
    
    //----returns projects by user_id---------------------------------
    
    //------creates a view row if the project is viewed for the first time
    
    public static function createViewForProject($proj_id){
        $db = Database::getDB();
        $query = "INSERT INTO views
                   (proj_id) 
                    VALUES(:proj_id)";
        $stm = $db->prepare($query);
        $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        return $row_count;
    }

    //---------checks if view already exists, creates new if not, increments existing view if yes
    
    public static function addView($proj_id){
        $db = Database::getDB();
        $view = ViewDB::getViewByProjId($proj_id);
                
        if(is_null($view["view_id"])){
            ViewDB::createViewForProject($proj_id);
        }
        $query = "UPDATE views SET num_views = num_views + 1 
                WHERE proj_id = :proj_id";
        $stm = $db->prepare($query);
        $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        
        return $row_count;
        
    }
    
    //--------get a list of User's own projects
    
    public static function getUsersProjects($user_id){
        $db = Database::getDB();
        
        $query = "SELECT * FROM projects WHERE user_id = :user_id ORDER BY proj_id DESC";
        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        $projects = array();
        foreach($result as $row)
        {
            $project = new Project(
                    $row['user_id'],
                    $row['cat_id'],
                    $row['proj_title'],
                    $row['proj_description'],
                    $row['proj_thumb'],
                    $row['proj_date'],
                    $row['featured']
                    );
            $project->setID($row['proj_id']);
            $projects[] = $project;
        }
        return $projects;
    }
}
