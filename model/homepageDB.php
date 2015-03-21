<?php

class HomepageDB {

	public static function getHomeInfo(){

		$db = Database::getDB();

        $query = "SELECT * FROM homepage "
                . "WHERE home_id = 1 ";

        $stm = $db->prepare($query);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);

            $home = [
                        'main_text'=>$row['main_text'],
                        'sub_text'=>$row['sub_text'],
                        'button_text'=>$row['button_text'],
                        'button_link'=>$row['button_link'],
                        'main_img_url'=>$row['main_img_url']
                        ];
             
        return $home;

	}

	public static function updateText($text){

        $db = Database::getDB();

        $cat_title = $category->getTitle();
        $cat_description = $category->getDesc();
        $cat_icon = $category->getIcon();

        $query = "UPDATE category SET 
                    cat_title = '$cat_title',
                    cat_description = '$cat_description',
                    cat_icon = '$cat_icon'
                    WHERE home_id = 1";

        $stm = $db->prepare($query);
        $stm->bindParam(":cat_id", $cat_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        
        return $row_count;    
    }

    public static function updateImage($category, $cat_id){

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




}
