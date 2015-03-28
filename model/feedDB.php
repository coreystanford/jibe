<?php

spl_autoload_register('FeedDB::getLimitAndLoads');
spl_autoload_register('FeedDB::updateLimitAndLoads');

class FeedDB {  

    // ------ Update Limit and Load ------ //

    public static function getLimitAndLoads(){

        $db = Database::getDB();

        $query = "SELECT * FROM feeds
                  WHERE feed_id = 1";

        $stm = $db->prepare($query);
        $result = $stm->execute();

        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return $row;    
    } 

    // ------ Update Limit and Load ------ //

    public static function updateLimitAndLoads($limit, $loads){

        $db = Database::getDB();

        $query = "UPDATE feeds SET 
                    feed_limit = '$limit',
                    feed_loads = '$loads'
                    WHERE feed_id = 1";

        $stm = $db->prepare($query);
        $row_count = $stm->execute();
        
        return $row_count;    
    }  

}
