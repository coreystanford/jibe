<?php

class Lists {

	public static function getCategoryTitles() {

        $db = Database::getDB();

        $query = "SELECT cat_title FROM category";
        $stm = $db->prepare($query);
        $stm->execute();

        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $categories = array();
        foreach($result as $cat){
            $categories[] = $cat['cat_title'];
        }

        return $categories;
    }


}
