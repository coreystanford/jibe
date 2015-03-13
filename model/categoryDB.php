<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categoryDB
 *
 * @author ILecoche
 */
class CategoryDB {
    //put your code here
    public static function getCategories(){
        $db = Database::getDB();
        $query = "SELECT * FROM category "
                . "ORDER BY cat_title";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $categories = array();
                foreach ($result as $row) {
                    $category = new Category(
                            $row['cat_title'],
                            $row['cat_description'],
                            $row['cat_icon']
                            );
                    $category->setID($row['cat_id']);
                    $categories[] = $category;
                }
        return $categories;
        
    }
    
    public static function getCategoryById($id){
        $db = Database::getDB();
        $query = "SELECT * FROM category "
                . "WHERE cat_id = :cat_id "
                . "ORDER BY cat_title";
        $stm = $db->prepare($query);
        $stm->bindParam(":cat_id", $id, PDO::PARAM_INT);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
            $category = new Category(
                            $row['cat_title'],
                            $row['cat_description'],
                            $row['cat_icon']
                            );
            $category->setID($row['cat_id']);
             
        return $category;
        
    }
}
