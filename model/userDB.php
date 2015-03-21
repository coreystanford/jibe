<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userDB
 *
 * @author ILecoche
 */
class userDB {
    //put your code here
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
}
