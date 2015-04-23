<?php

spl_autoload_register('userDB::getUsers');
spl_autoload_register('userDB::getUserById');
spl_autoload_register('userDB::getUsersForSearch');
spl_autoload_register('userDB::updateUser');
spl_autoload_register('userDB::updateImagePath');
spl_autoload_register('userDB::deleteImagePath');
spl_autoload_register('userDB::deleteUser');

class userDB {

     public static function getUsers($sortby = 'lname'){
        $db = Database::getDB();
        $query = "SELECT * FROM users "
                . "ORDER BY :sortby";
        $stm = $db->prepare($query);
        $stm->bindParam(":sortby", $sortby, PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $users = array();
            foreach ($result as $row) {
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
                $users[] = $user;
                }
        return $users;
    }
    
    public static function getUserById($id){
        $db = Database::getDB();
        $query = "SELECT * FROM users "
                . "WHERE user_id = :user_id";
        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $id, PDO::PARAM_INT);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
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
        return $user;
    }
    
    public static function getUsersForSearch($searchQuery){
        $db = Database::getDB();
        $searchQuery = strtolower($searchQuery);
        $query = "SELECT * FROM users "
                ."WHERE LOWER(fname) like LOWER('%".$searchQuery."%') "
                ."OR LOWER(lname) like LOWER('%".$searchQuery."%') "
                ."OR LOWER(CONCAT(fname, ' ', lname)) like LOWER('%".$searchQuery."%') "
                ."ORDER BY fname";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $users = array();
            foreach ($result as $row) {
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
                $users[] = $user;
                }
        return $users;
    }

    public static function updateUser($user, $user_id){

        $db = Database::getDB();

        $fname = $user->getFName();
        $lname = $user->getLName();
        $city = $user->getCity();
        $country = $user->getCountry();
        $website = $user->getWebsite();
        $bio = addslashes($user->getBio());
        $specialty = $user->getSpecialty();

        $query = "UPDATE users SET 
                  fname = '$fname', 
                  lname = '$lname', 
                  city = '$city', 
                  country = '$country', 
                  website = '$website', 
                  bio = '$bio', 
                  specialty = '$specialty' 
                  WHERE user_id = :user_id";

        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        $row_count = $stm->execute();

        return $row_count;                 
    }

    public static function updateImagePath($user_id, $img){

        $db = Database::getDB();

        $query = "UPDATE users SET 
                  img_url = '$img' 
                  WHERE user_id = :user_id";

        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        $row_count = $stm->execute();

        return $row_count;                 
    }

    public static function deleteImagePath($user_id){

        $db = Database::getDB();

        $query = "UPDATE users SET 
                  img_url = 'default.jpg' 
                  WHERE user_id = :user_id";

        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        $row_count = $stm->execute();

        return $row_count;                 
    }

    public static function deleteUser($user_id){

        $db = Database::getDB();

        $query = "DELETE FROM users 
                  WHERE user_id = :user_id";

        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        $row_count = $stm->execute();

        $query = "DELETE FROM reports WHERE reporter_id = :user_id OR reported_id = :user_id";

        $stm = $db->prepare($query);
        $stm->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $row_count = $stm->execute();

        return $row_count;                 
    }

}

