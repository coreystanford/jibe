<?php

//path of the file temp folder
$file_temp = $_FILES['upfile']['tmp_name'];

$file_name = $_FILES['upfile']['name'];
$file_size = $_FILES['upfile']['size'];
$file_type = $_FILES['upfile']['type'];
$file_error = $_FILES['upfile']['error'];

echo $file_temp . "<br />";
echo $file_name . "<br />";
echo $file_size . "<br />";
echo $file_type . "<br />";
echo $file_error . "<br />";

if ($file_error > 0) {
    echo "Error : ";
    switch ($file_error){
        case 1:
            echo "file exceeded upload_max_filesize";
            break;
        case 2:
            echo "file exceeded max_filesize";
            break;
        case 3:
            echo "file partially uploaded";
            break;
        case 4:
            echo "no file uploaded";
            break;  
    }     
}
$max_file_size = 2000000;
if($file_size > $max_file_size) {
    echo "file too big";
}

$target_path = "uploads/";
$target_path = $target_path . $file_name;

if(move_uploaded_file(($file_temp), $target_path)) {
    echo "The file " . $file_name . " has been uploaded successfully";
}else {
    echo "There was a problem uploading " . $file_name;
}

