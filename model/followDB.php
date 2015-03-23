<?php

class FollowDB {

    // ------ Follow a Profile ------ //

    public static function followUser($followed, $follower){

        $db = Database::getDB();

        $query = "INSERT INTO follow
                   (user_followed, 
                    user_follower) 
                    VALUES(
                        '$followed', 
                        '$follower' 
                        )";

        $stm = $db->prepare($query);
        
        $row_count = $stm->execute();
        return $row_count;
    }

    // ------ Unfollow a Profile ------ //

    public static function unfollowUser($follow_id){

        $db = Database::getDB();

        $query = "DELETE FROM follow WHERE follow_id = :follow_id";

        $stm = $db->prepare($query);
        $stm->bindParam(':follow_id', $follow_id, PDO::PARAM_INT);
        $row_count = $stm->execute();

        return $row_count;
    }   

}
