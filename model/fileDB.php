<?php

class FileDB {
    
    public static function insertImagesToProject($project, $proj_id) {
        $db = Database::getDB();
        
        $attribute = $project->getAttribute();
        $media_url = $project->getURL();
       
        
        $query = "INSERT INTO media
                   (file_url,
                    file_attribute) 
                    
                    VALUES(
                        '$media_url',
                        '$attribute'  
                        )";

        $stm = $db->prepare($query);
        $row_count = $stm->execute();
        
        if($row_count){
            $query = "SELECT MAX(file_id) as max_id from media";
            $stm = $db->prepare($query);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            $file_id = $result['max_id'];
        } else {
            return $row_count;
        }
        
        $query = "INSERT INTO proj_media
                   (file_id,
                    proj_id) 
                    
                    VALUES(
                        '$file_id',
                        '$proj_id'  
                        )";
        
        $stm = $db->prepare($query);
        $row_count = $stm->execute();
        
        return $row_count;
   
    }

    
    
}


 

