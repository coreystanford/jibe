<?php
 //require '../config.php';

//require(MODEL_PATH . 'database.php');
//require(MODEL_PATH . 'user.php');
//require(MODEL_PATH . 'userDB.php');
//require(MODEL_PATH . 'project.php');
//require(MODEL_PATH . 'projectDB.php');
//require(MODEL_PATH . 'category.php');
//require(MODEL_PATH . 'categoryDB.php');
//require(MODEL_PATH . 'comment.php');
//require(MODEL_PATH . 'commentDB.php');
//require(MODEL_PATH . 'fields.php');
//require('MODEL_PATH' . 'validate.php');

//if (isset($_POST['proj_id']) && (!empty($_POST['proj_id']))) {
//    $proj_id = $_POST['proj_id'];
//} else if (isset($_GET['proj_id']) && (!empty($_GET['proj_id']))) {
//    $proj_id = $_GET['proj_id'];
//} else {
//    $proj_id = $project->getID();
//}

$user_id = $id;
//$proj_id = 5;
$now_date = new DateTime();
$cmt_date = $now_date->format('Y-m-d H:i:s');
$cmt_msg = '';
$message_fail = '';
$message_success = '';

// initiate validation for comment message
$newCommentValidate = new Validate;
$newcommentfields = $newCommentValidate->getFields();
$newcommentfields->addField('cmt_msg');

// if comment was submitted
if (isset($_POST['submit_comment'])){
    

    $cmt_msg = $_POST['cmt_msg'];

    $newCommentValidate->text('cmt_msg', $cmt_msg, true, 1, 350);

    if(!$newcommentfields->hasErrors()){
        $user = UserDB::getUserById($user_id);
        $project = ProjectDB::getProjectByID($proj_id);
        $new_comment = new Comment($user, $project, $cmt_msg, $cmt_date);
       // var_dump($new_comment);

            if (CommentDB::addComment($new_comment) != 1) {
                $message_fail = "Failed to add the comment";
                $comments = CommentDB::getComments($user_id, $proj_id);
                include 'form.php';
                include 'list.php';
            } else {
                $message_success = "New comment added successfully!";
                $comments = CommentDB::getComments($user_id, $proj_id);
                include('list.php');   
            }
    } 
} else {
    //if no form was submitted

    $comments = CommentDB::getComments($user_id, $proj_id);
    echo $user_id . "<br/>";
    echo $proj_id . "<br/>";
   // var_dump($comments);
        if(!empty($comments)){
        //  --if comments exist, load comments
            include 'list.php';
            include 'form.php';
        } else {
        // -- load form
            include 'form.php';
        }
}

