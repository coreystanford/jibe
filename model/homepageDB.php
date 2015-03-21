<?php

class HomepageDB {

    // ------ Get All Homepage Information ------ //

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

    // ------ Update Homepage Text ------ //

	public static function updateText($text){

        $db = Database::getDB();

        $main_text = $text['main_text'];
        $sub_text = $text['sub_text'];
        $button_text = $text['button_text'];
        $button_link = $text['button_link'];

        $query = "UPDATE homepage SET 
                    main_text = '$main_text',
                    sub_text = '$sub_text',
                    button_text = '$button_text',
                    button_link = '$button_link'
                    WHERE home_id = 1";

        $stm = $db->prepare($query);
        $row_count = $stm->execute();
        
        return $row_count;    
    }

    // ------ Update Homepage Background Image ------ //

    public static function updateImage($img){

        $db = Database::getDB();

        $query = "UPDATE homepage SET 
                    main_img_url = '$img'
                    WHERE home_id = 1";

        $stm = $db->prepare($query);
        $row_count = $stm->execute();
        
        return $row_count;    
    }

    // ------ Get All Featured Projects ------ //

    public static function getFeatured(){

        $db = Database::getDB();
        $query = "SELECT * FROM projects p 
                JOIN category c ON p.cat_id = c.cat_id 
                JOIN users u ON p.user_id = u.user_id 
                WHERE featured = 1";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $projects = array();

        foreach ($result as $row) {

            $category = new Category(
                    $row['cat_title'],
                    $row['cat_description'],
                    $row['cat_icon']);
            $category->setID($row['cat_id']);

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

            $project = new Project(
                    $user,
                    $category,
                    $row['proj_title'],
                    $row['proj_description'],
                    $row['proj_thumb'],
                    $row['proj_date'],
                    $row['featured']);
            $project->setID($row['proj_id']);

            $projects[] = $project;

        }
        return $projects;
    }

    // ------ Get All Unfeatured Projects ------ //

    public static function getUnfeatured(){

        $db = Database::getDB();
        $query = "SELECT * FROM projects p 
                JOIN category c ON p.cat_id = c.cat_id 
                JOIN users u ON p.user_id = u.user_id 
                WHERE featured = 0";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $projects = array();

        foreach ($result as $row) {

            $category = new Category(
                    $row['cat_title'],
                    $row['cat_description'],
                    $row['cat_icon']);
            $category->setID($row['cat_id']);

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

            $project = new Project(
                    $user,
                    $category,
                    $row['proj_title'],
                    $row['proj_description'],
                    $row['proj_thumb'],
                    $row['proj_date'],
                    $row['featured']);
            $project->setID($row['proj_id']);

            $projects[] = $project;

        }
        return $projects;
    }

    // ------ Add A Featured Project------ //

    public static function addFeatured($project, $proj_id){

        $db = Database::getDB();

        $cat_title = $project->getTitle();
        $cat_description = $project->getDesc();
        $cat_icon = $project->getIcon();

        $query = "UPDATE projects SET 
                    cat_title = '$cat_title',
                    cat_description = '$cat_description',
                    cat_icon = '$cat_icon'
                    WHERE cat_id = :proj_id";

        $stm = $db->prepare($query);
        $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        
        return $row_count;    
    }

    // ------ Remove A Featured Project ------ //

    public static function removeFeatured($project, $proj_id){

        $db = Database::getDB();

        $cat_title = $project->getTitle();
        $cat_description = $project->getDesc();
        $cat_icon = $project->getIcon();

        $query = "UPDATE projects SET 
                    cat_title = '$cat_title',
                    cat_description = '$cat_description',
                    cat_icon = '$cat_icon'
                    WHERE cat_id = :proj_id";

        $stm = $db->prepare($query);
        $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        
        return $row_count; 
    }

}
