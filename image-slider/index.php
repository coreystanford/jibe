<?php

require '../config.php';
require '../model/autoload.php';

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
        //$fileupload = new FileUpload;
        //$fileupload->setFilename($_FILES['proj_thumb']['name']);
        //$fileupload->uploadFile($_FILES['proj_thumb']);
        //$fileupload->createProjectThumb($_FILES['proj_thumb']['name']);
    }
    
}

require_once 'slider-setup.php';
?>
