<?php

spl_autoload_register('HomepageDB::getHomeInfo');
spl_autoload_register('HomepageDB::updateText');
spl_autoload_register('HomepageDB::updateImage');
spl_autoload_register('HomepageDB::getFeatured');
spl_autoload_register('HomepageDB::getFeaturedByID');
spl_autoload_register('HomepageDB::getUnfeatured');
spl_autoload_register('HomepageDB::addFeature');
spl_autoload_register('HomepageDB::removeFeature');

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

        return self::processProjects($result); //helper at bottom
    }

    // ------ Get Featured Project by ID for Homepage Modal ------ //

    public static function getFeaturedByID($proj_id){

        $db = Database::getDB();
        $query = "SELECT proj_thumb FROM projects 
                WHERE proj_id = :proj_id";
        $stm = $db->prepare($query);
        $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
        $stm->execute();
        $project = $stm->fetch(PDO::FETCH_ASSOC);

        return $project;
    }

    // ------ Get All Unfeatured Projects ------ //

    public static function getUnfeatured($offset, $limit){

        $db = Database::getDB();
        $query = "SELECT * FROM projects p 
                JOIN category c ON p.cat_id = c.cat_id 
                JOIN users u ON p.user_id = u.user_id 
                WHERE featured = 0 
                LIMIT $offset, $limit";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return self::processProjects($result); // helper at bottom
    }

    // ------ Add A Featured Project------ //

    public static function addFeature($proj_id){

        $db = Database::getDB();

        $query = "UPDATE projects SET 
                    featured = 1
                    WHERE proj_id = :proj_id";

        $stm = $db->prepare($query);
        $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        
        return $row_count;    
    }

    // ------ Remove A Featured Project ------ //

    public static function removeFeature($proj_id){

        $db = Database::getDB();

        $query = "UPDATE projects SET 
                    featured = 0
                    WHERE proj_id = :proj_id";

        $stm = $db->prepare($query);
        $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
        $row_count = $stm->execute();
        
        return $row_count; 
    }
    
    // ------ Function for logging previously registered user into the site  ------ //
    public static function userLogin($email, $password) {
        $db = Database::getDB();
        
        $query = "SELECT * FROM user_info WHERE email='$email'";        
        
        $stm = $db->prepare($query);
	$stm->execute();
        $row_count = $stm->fetch(PDO::FETCH_ASSOC);
        
        return $row_count;   
        
    }
     // ------ function to set session for user logged into account------ //
    public static function setSession($userid) {
        
        session_regenerate_id();
        $_SESSION['valid'] = 1;
        $_SESSION['user_id'] = $userid;
        //var_dump($_SESSION);
    }
    
    // ------ function for logging registered and loggout in user out of their account ------ //
    public static function userLogout() {
        //$db = Database::getDB();
        
        $_SESSION = array();
        session_destroy();
    }
    
    // ------ function for keeping secure sessions. ------ // 
    function isLoggedIn() {
        if(isset($_SESSION['valid']) && $_SESSION['valid'])
            return true;
        return false;
    }
    
    // ------ Function for registering a new user with an account for the site. ------ //
    
    public static function userRegister($fname, $lname, $email, $password) {
        $db = Database::getDB();
        
        $query = "INSERT INTO users 
                    (fname, 
                    lname) 
                    VALUES('$fname', '$lname')";
        
        $stm = $db->prepare($query);
        $stm->execute();      
        
        $user_id = $db->lastinsertid();

        $query = "INSERT INTO user_info 
                    (user_id, 
                    email, 
                    password, 
                    role) 
                    VALUES('$user_id', '$email', '$password', '0')";
        var_dump($query);
        $stm = $db->prepare($query);
        $stm->execute();
        $row_count = $stm->fetch(PDO::FETCH_ASSOC);
        
        return $row_count;
    }
    
    // ------ Helper - Process Projects ------ //

    private static function processProjects($result){

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

}
