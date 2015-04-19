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
                    $row['proj_date'],
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
    
    public static function getViews($user_id, $proj_id = -1){
         $db = Database::getDB();
        $query = "SELECT * FROM views "
                . "JOIN projects ON views.proj_id = projects.proj_id "
                . "JOIN users ON projects.user_id = users.user_id "
                . "WHERE users.user_id = :user_id "
                . "ORDER BY views.proj_id";
        if($proj_id >= 0){
            $stm = $db->prepare($query . " AND views.proj_id = :proj_id");
            $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stm->bindParam(":proj_id", $proj_id, PDO::PARAM_INT);
        } else {
            $stm = $db->prepare($query);
            $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        }
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $views = array();

        foreach ($result as $row) {
            $views[] = StatsDB::populateView($row);
        }
        return $views;
    }
    
}
