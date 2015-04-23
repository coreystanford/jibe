<?php

/*
    Author: Wilston Dsouza
    This file acts as the controller for the image slider.
    It serves all the requests by getting all the required 
    data from the database, and rendering the appropriate view
*/

require '../config.php';
require '../errors/errorhandler.php';
require '../model/autoload.php';

if (!isset($_SESSION)){
    session_start();
}

if(!HomepageDB::isLoggedIn()){
    header("Location: ../");
    die();
}

if (!isset($_SESSION)) {
    session_start();
}

$user_id = $_SESSION['user_id'];

$iValidate = new Validate;
$iFields = $iValidate->getFields();
$iFields->addField('image_input');


if (isset($_POST['send']) && $_POST['action'] == 'validate-image') {
    $imageInput = '';
    if (isset($_FILES['image_input'])) {
        $imageInput = $_FILES['image_input'];
    }
    $iValidate->upload('image_input', $imageInput);
    
    if(!$iFields->hasErrors()) {
        //File upload
        $fileupload = new FileUpload;
        $fileupload->setFilename($_FILES['image_input']['name']);
        $fileupload->uploadSliderImage($_FILES['image_input'], "../images_upload/slider-images/".$_FILES['image_input']['name']);
        //$fileupload->createSliderImage($_FILES['image_input']['name']);
        
        //Add to database
        $img_name = $fileupload->getFilename();
        $image = new SliderImage($user_id,$img_name);
        SliderImageDB::addImage($image);
        
        
    }
    
}
else if (isset($_POST['delete']) && $_POST['action'] == 'delete-image') {
    $img_id = $_POST['img_id'];
    SliderImageDB::deleteImage($img_id);
}

$images = SliderImageDB::getImagesByUser($user_id);

require_once 'slider-setup.php';
?>
