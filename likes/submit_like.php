<?php
require '../config.php';
require(MODEL_PATH . 'database.php');
require(MODEL_PATH . 'user.php');
require(MODEL_PATH . 'userDB.php');
require(MODEL_PATH . 'project.php');
require(MODEL_PATH . 'projectDB.php');
require(MODEL_PATH . 'category.php');
require(MODEL_PATH . 'categoryDB.php');
require(MODEL_PATH . 'like.php');
require(MODEL_PATH . 'likeDB.php');
require(MODEL_PATH . 'fields.php');




    $message_fail = '';
    $message_success = '';
    
    $user_id = $_POST['user_id'];
    $proj_id = $_POST['proj_id'];
    
  
        $user = UserDB::getUserById($user_id);
        $project = ProjectDB::getProjectByID($proj_id);
        $new_like = new Like($user, $project);
       // var_dump($new_comment);

        if(isset($_POST['action']) && $_POST['action'] == "Like"){
            if (LikeDB::likeProject($user_id, $proj_id) != 1) {
                //echo "Failed to like";
                //$countLikes = LikeDB::countLikes($proj_id);
                
            } else {
                $total_likes = LikeDB::getLikesByProjId($proj_id);
                
                //echo "Thank you! Now " . count($total_likes). " awesome person(s) like my work." ;
                //$countLikes = LikeDB::countLikes($proj_id);
                //include('success.php');   
            }
        }    
        if(isset($_POST['action']) && $_POST['action'] == "Unlike"){
            if (LikeDB::unlikeProject($user_id, $proj_id) != 1) {
                //echo "Failed to unlike";
                //$countLikes = LikeDB::countLikes($proj_id);
                
            } else {
                //echo "Sorry to let you down!";
                //$countLikes = LikeDB::countLikes($proj_id);
                //include('success.php');   
            }
        }

