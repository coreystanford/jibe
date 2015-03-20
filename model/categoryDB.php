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
    
    // ------ Get All Categories ------ //

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

    // ------ Get A Category By ID ------ //
    
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

    // ------ Get Project Count By Category ID ------ //

    public static function getCategoriesWithCount(){

        $db = Database::getDB();

        $query = "SELECT COUNT(p.cat_id) AS cat_count, c.cat_id, cat_title, cat_description, cat_icon 
                  FROM projects p 
                  JOIN  category c 
                  ON c.cat_id = p.cat_id 
                  ORDER BY cat_title ";

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
                $category->setProjCount($row['cat_count']);

                $categories[] = $category;
            }

        return $categories;
    }

    // ------ Insert A Category ------ //

    public static function insertCategory($category){

        $db = Database::getDB();

        $cat_title = $category->getTitle();
        $cat_description = $category->getDesc();
        $cat_icon = $category->getIcon();
        
        $query = "INSERT INTO category
                   (cat_title,
                    cat_description,
                    cat_icon) 
                    VALUES(
                        '$cat_title',
                        '$cat_description',
                        '$cat_icon'
                        )";

        $stm = $db->prepare($query);
        $row_count = $stm->execute();
        return $row_count;
    }

    // ------ Update A Category ------ //

    public static function updateCategory($category, $cat_id){

        $db = Database::getDB();

        $cat_title = $category->getTitle();
        $cat_description = $category->getDesc();
        $cat_icon = $category->getIcon();

        $query = "UPDATE category SET 
                    cat_title = '$cat_title',
                    cat_description = '$cat_description',
                    cat_icon = '$cat_icon'
                    WHERE cat_id = :cat_id";

        $stm = $db->prepare($query);
        $stm->bindParam(":cat_id", $cat_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        
        return $row_count;    
    }

    // ------ Delete A Category ------ //

    public static function deleteCategory($cat_id){

        $db = Database::getDB();

        $query = "DELETE FROM category WHERE cat_id = :cat_id";

        $stm = $db->prepare($query);
        $stm->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        return $row_count;
    }
}
