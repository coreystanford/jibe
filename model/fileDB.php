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
        
        
        $query = "INSERT INTO proj_media
                   (file_id,
                    proj_id) 
                    
                    VALUES(
                        '$file_id',
                        '$proj_id'  
                        )";
        
        return $row_count;
   
    }

    
    
}


 

