<?php
require '../config.php';
require(MODEL_PATH . 'database.php');
require(MODEL_PATH . 'user.php');
require(MODEL_PATH . 'userDB.php');
require(MODEL_PATH . 'project.php');
require(MODEL_PATH . 'projectDB.php');
require(MODEL_PATH . 'category.php');
require(MODEL_PATH . 'categoryDB.php');
require(MODEL_PATH . 'comment.php');
require(MODEL_PATH . 'commentDB.php');
require(MODEL_PATH . 'fields.php');
require(MODEL_PATH . 'validate.php');

// file to process form



// initiate validation for comment message
$newCommentValidate = new Validate;
$newcommentfields = $newCommentValidate->getFields();
$newcommentfields->addField('cmt_msg');

    
    $message_fail = '';
    $message_success = '';
    
// retrieving POST data from the submitted form    
    
    $user_id = $_POST['user_id'];
    $proj_id = $_POST['proj_id'];
    $now_date = new DateTime();
    $cmt_date = $now_date->format('Y-m-d H:i:s');
    $cmt_msg = $_POST['cmt_msg'];
    
    //---validating a single field----------

    $newCommentValidate->text('cmt_msg', $cmt_msg, true, 1, 350);

    if(!$newcommentfields->hasErrors()){
        $user = UserDB::getUserById($user_id);
        $project = ProjectDB::getProjectByID($proj_id);
        $new_comment = new Comment($user, $project, $cmt_msg, $cmt_date);
       // var_dump($new_comment);

    // adding a comment----------------------
            if (CommentDB::addComment($new_comment) != 1) {
                $message_fail = "Failed to add the comment";
                $comments = CommentDB::getComments($proj_id);
                include 'form.php';
                include 'list.php';
            } else {
                $message_success = "New comment added successfully!";
                $lastcomment = CommentDB::getLastComment($proj_id);
                $comments = CommentDB::getComments($proj_id);
                include 'success.php';
                include 'list.php';
            }
    } 

