<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of commentDB
 *
 * @author ILecoche
 */
class CommentDB {
    
    //function to instatiate Comment object based on result of database query
    private static function populateComment($row){
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
            $comment = new Comment(
                    $user,
                    $project, 
                    $row['cmt_msg'],
                    $row['cmt_date']);
            $comment->setID($row['cmt_id']);
            
            return $comment;
    }
    //-- function to get all comments for selected user
    //---proj_id adds filter by project id
    public static function getComments($proj_id){

        $db = Database::getDB();
        $query = "SELECT * FROM comments "
                . "JOIN users ON comments.user_id = users.user_id "
                . "JOIN projects ON comments.proj_id = projects.proj_id "
                . "WHERE comments.proj_id = :proj_id";
            $stm = $db->prepare($query . " AND comments.proj_id = :proj_id");
            $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
       
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $comments = array();

        foreach ($result as $row) {
            $comments[] = CommentDB::populateComment($row);
        }
        return $comments;
    }
    
    //-function to get last added comment
    public static function getLastComment($proj_id){

        $db = Database::getDB();
        $query = "SELECT * FROM comments "
                . "JOIN users ON comments.user_id = users.user_id "
                . "JOIN projects ON comments.proj_id = projects.proj_id "
                . "WHERE comments.proj_id = :proj_id "
                . "ORDER BY cmt_id DESC LIMIT 1";
            $stm = $db->prepare($query);
            $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
        
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $comment = CommentDB::populateComment($row);
        
        return $comment;
    }
    
    // adding new job based oon parameter (Job object)
    public static function addComment($comment){
        $db = Database::getDB();
        //var_dump($comment);
        $user_id = $comment->getUser()->getID();
        $proj_id = $comment->getProject()->getID();
        $comment_msg = $comment->getComment();
        $comment_date = $comment->getDate();
        
        $query = "INSERT INTO comments
                   (user_id,
                    proj_id,
                    cmt_msg,
                    cmt_date) 
                    VALUES(
                        :user_id,
                        :proj_id,
                        :cmt_msg,
                        :cmt_date
                        )";
        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
        $stm->bindParam(":cmt_msg", $comment_msg, PDO::PARAM_STR);
        $stm->bindParam(":cmt_date", $comment_date, PDO::PARAM_STR);
        $row_count = $stm->execute();
        return $row_count;
                         
    }
    //---function to delete comment
    public static function deleteComment($cmt_id){

        $db = Database::getDB();
        $query = "DELETE FROM comments WHERE cmt_id = :cmt_id";
        $stm = $db->prepare($query);
        $stm->bindParam(':cmt_id', $cmt_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        return $row_count;
    }
    
    //---function to publish comment
//    public static function publishComment($cmt_id){
//        
//    }
   
    
}
