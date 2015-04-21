<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of likeDB
 *
 * @author ILecoche
 */
class LikeDB {
    
    //function to instatiate Like object based on result of database query
    private static function populateLike($row){
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
            $project = new Project(
                    $row['user_id'],
                    $row['cat_id'],
                    $row['proj_title'],
                    $row['proj_description'],
                    $row['proj_thumb'],
                    $row['featured']
                    );
            $project->setID($row['proj_id']);
            $like = new Like(
                    $user,
                    $project);
            $like->setID($row['like_id']);
            
            return $like;
    }
    
    // ------get list of projects that this user likes---------
    
    public static function getLikesByUserId($user_id){
        
        $db = Database::getDB();
        $query = "SELECT * FROM likes "
                . "JOIN projects ON likes.proj_id = projects.proj_id "
                . "JOIN users ON likes.user_id = users.user_id "
                . "WHERE likes.user_id = :user_id";
        $stm = $db->prepare($query);
            $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $likes = array();
        foreach ($result as $row){
            $likes[] = LikeDB::populateLike($row);
        }
        
        return $likes;
    }
    
    // -------get list of users that like this project----------
    
    public static function getLikesByProjId($proj_id){
        
        $db = Database::getDB();
        $query = "SELECT * FROM likes "
                . "JOIN projects ON likes.proj_id = projects.proj_id "
                . "JOIN users ON likes.user_id = users.user_id "
                . "WHERE likes.proj_id = :proj_id";
        $stm = $db->prepare($query);
            $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
            $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $likes = array();
        foreach ($result as $row){
            $likes[] = LikeDB::populateLike($row);
        }
        
        return $likes;
    }
    
    // ------------checking if User already likes this project--------
    
    public static function checkUserLikesProject($user_id, $proj_id){
        
        $db = Database::getDB();
        $query = "SELECT like_id FROM likes "
                . "WHERE likes.proj_id = :proj_id AND "
                . "likes.user_id = :user_id";
        $stm = $db->prepare($query);
            $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
            $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $like_id = $row['like_id'];
        return $like_id;
    }


    // --------------"Like" the project-----------------------
    
    public static function likeProject($user_id, $proj_id){
        
        $like = LikeDB::checkUserLikesProject($user_id, $proj_id);
        
        if(is_null($like)){
            $db = Database::getDB();
            $query = "INSERT INTO likes
                   (user_id, proj_id) 
                    VALUES(:user_id, :proj_id)";
        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        return $row_count;
        }
        else {
            return 0;
        }
    }

    // ---------------"Unlike" the project-----------------------
        
    public static function unlikeProject($user_id, $proj_id){
        
        $like = LikeDB::checkUserLikesProject($user_id, $proj_id);
        
        if(!is_null($like)){
            $db = Database::getDB();
            $query = "DELETE FROM likes 
                   WHERE like_id = :like_id";
        $stm = $db->prepare($query);
        $stm->bindParam(":like_id", $like, PDO::PARAM_INT);
        $row_count = $stm->execute();
        return $row_count;
        }
        else{
            return 0;
        }
    }
    
}
