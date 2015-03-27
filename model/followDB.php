<?php

spl_autoload_register('FollowDB::followUser');
spl_autoload_register('FollowDB::unfollowUser');
spl_autoload_register('FollowDB::checkFollow');

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

    public static function unfollowUser($followed, $follower){

        $db = Database::getDB();

        $query = "DELETE FROM follow
                  WHERE user_followed = :followed AND user_follower = :follower";

        $stm = $db->prepare($query);
        $stm->bindParam(':followed', $followed, PDO::PARAM_INT);
        $stm->bindParam(':follower', $follower, PDO::PARAM_INT);
        $row_count = $stm->execute();

        return $row_count;
    }    

    // ------ Check Follow Status ------ //

    public static function checkFollow($followed, $follower){

        $db = Database::getDB();

        $query = "SELECT *
                  FROM follow 
                  WHERE user_followed = :followed AND user_follower = :follower";

        $stm = $db->prepare($query);
        $stm->bindParam(':followed', $followed, PDO::PARAM_INT);
        $stm->bindParam(':follower', $follower, PDO::PARAM_INT);
        $row_count = $stm->execute();
        $result = $stm->fetch();

        return $result;
    }   

}
