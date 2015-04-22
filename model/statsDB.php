<?php


/**
 * Description of statsDB
 *
 * @author ILecoche
 */
class StatsDB {
    
    //function to instatiate View object based on result of database query
    private static function populateView($row){
            $user = new User(
                    $row['fname'],
                    $row['lname'],
                    $row['city'],
                    $row['country'],
                    $row['website'],
                    $row['img_url'],
                    $row['bio'],
                    $row['specialty']
                    );
            $user->setID($row['user_id']);
            $project = new Project(
                    $row['user_id'],
                    $row['cat_id'],
                    $row['proj_title'],
                    $row['proj_description'],
                    $row['proj_thumb'],
                    $row['featured']
                    );
            $project->setID($row['proj_id']);
            $view = new View(
                    $user,
                    $project, 
                    $row['num_views']);
            $view->setID($row['cmt_id']);
            
            return $view;
    }
    
    // Graph function - get array of views for ALL projects
    
    public static function getAllViews($user_id){
        $db = Database::getDB();
        $query = "SELECT projects.proj_title, views.num_views FROM projects "
                . " LEFT JOIN views ON projects.proj_id = views.proj_id "
                . " WHERE projects.user_id = :user_id "
                . " ORDER BY projects.proj_title";
        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    // Graph function - get array of likes for ALL projects
    
    public static function getAllLikes($user_id){
        $db = Database::getDB();
        $query = "SELECT p.proj_title, IFNULL(l.count,0) AS count FROM projects AS p "
                . " LEFT JOIN ( "
                . " SELECT proj_id, COUNT(*) AS count "
                . " FROM likes GROUP BY proj_id) AS l "
                . " ON p.proj_id = l.proj_id "
                . " WHERE p.user_id = :user_id "
                . " ORDER BY p.proj_title ASC";
        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    // Graph function - get array of comments for ALL projects
    
    public static function getAllComments($user_id){
        $db = Database::getDB();
        $query = "SELECT p.proj_title, IFNULL(c.count,0) AS count FROM projects AS p "
                . " LEFT JOIN ( "
                . " SELECT proj_id, COUNT(*) AS count "
                . " FROM comments GROUP BY proj_id) AS c "
                . " ON p.proj_id = c.proj_id "
                . " WHERE p.user_id = :user_id "
                . " ORDER BY p.proj_title ASC";
        $stm = $db->prepare($query);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
