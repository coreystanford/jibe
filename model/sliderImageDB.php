<?php

require_once 'sliderImage.php';

/**
 * Description of sliderImageDB
 *
 * @author Wilston
 */
class SliderImageDB {
    
    public static function getImagesByUser($user_id) {

        $db = Database::getDB();
        $query = "SELECT * FROM slider_images "
                    ."WHERE user_id = " 
                    .$user_id;

               
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $images = array();
        
        foreach ($result as $row) {
            $image = new SliderImage(
                $row['user_id'],
                $row['img_name']);
                $image->setID($row['id']);   
                
            $images[] = $image;
        }
        
        return $images;
        
    }
    
    public static function addImage($image) {
        $db = Database::getDB();

        $query =
            "INSERT INTO slider_images "
             ."VALUES "
                 ."( null, ".$image->getUserID().", '".$image->getImgName()."');";

        $row_count = $db->exec($query);
        return $row_count;
    }
    
    public static function deleteImage($id) {
        $db = Database::getDB();

        $query =
            "DELETE FROM slider_images WHERE id = ".$id.";";
             
        $row_count = $db->exec($query);
        return $row_count;
    }
    
}
