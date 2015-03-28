<?php

/*
 * Used this example as a tutorial 
 * http://digipiph.com/blog/simple-php-class-used-uploading-files-and-images.
 */

/**
 * Description of file_upload
 *
 * @author ILecoche
 */
class FileUpload {
    private $_target = '../images_upload/'; // default file upload directory
    private $_extensions = array('jpg', 'gif', 'png', 'jpeg'); // default array of allowed extensions
    private $_sizelimit = '3145728'; // 3Mb
    private $_filename = 'placeholder.img'; // default filename to be replaced later
    public $_fm_error  = '';
    
    //functions to change default upload directory
    public function setTarget($target){
        $this->_target = $target;
    }
    //functions to change default array of extensions
    public function setExtensions($extensions){
        if(is_array($extensions)){
            $this->_extensions = $extensions;
        } else {
            $newextensionarray = array($extensions);
            $this->_extensions = $newextensionarray;
        }
    }
    //function to change default size limit
    public function setSizeLimit($sizelimit){
        $this->_sizelimit = $sizelimit;
    }
    //function to change default filename
    public function setFilename($filename){
        $this->_filename = $filename;
    }
    
    // extract file extension from passed $file parameter
    public function getExtension($file){
        $filename_full = $file['name'];
        $extension = pathinfo($filename_full, PATHINFO_EXTENSION);
        return $extension;
    }
    
    // function to verify if image file has an allowed extension and size
    public function validateFile($file){
        $validationError = '';
        //check if file exists
        if(empty($file['name'])) {
            $validationError = 'You are attempting to upload non-existent file. ';
        } else {
            //check if file has an extension the is allowed for upload
            if(!in_array($this->getExtension($file), $this->_extensions)){
                $validationError = 'File extension ' . $this->getExtension($file) . ' is not allowed. ';
            }
            //check if file is within size limit
            if($file['size'] > $this->_sizelimit){
                $validationError .= 'File exceeded size limit of ' . $this->_sizelimit . " bytes.";
            }
        }
        $this->_fm_error  = $validationError;
    }
    
    // function to upload file
    public function uploadFile($file){
        $this->validateFile($file);
        if(!empty($this->_fm_error)){
            echo $this->_fm_error ;
        }
        else {
            if(!move_uploaded_file($file['tmp_name'], $this->_target.$this->_filename)){
                $this->_fm_error .= 'Error uploading file';
            }
            
            //echo $file['tmp_name'].'<br />';
            //echo $this->_target.$this->_filename;

            if($this->_fm_error ){
                echo $this->_fm_error ;
            }
        }
    }
    // function to delete file
    public function deleteFile($file){
        if(file_exists($this->_target.$file)) {
            $delete_result = unlink($this->_target.$file);
            if(!$delete_result){
                $this->_fm_error  .= 'Image file ' . $file . ' exists but was not deleted';
            }
        }
        else {
            $this->_fm_error  .= 'Image file ' . $file . ' does not exist';
        }
        if($this->_fm_error ){
            echo $this->_fm_error ;
        }
    }
    //function to display errors
    public function displayErrors(){
        if ($this->_fm_error !=''){
        return "<span class='error'>" . $this->_fm_error . "</span>";
        } else {return '';}
    }

    //Source Murach's PHP and MySQL Ch. 23

    public function createProfileThumbs($filename, $dir = "../images_upload") {
        // Set up the variables
        $dir = $dir . DIRECTORY_SEPARATOR;
        $i = strrpos($filename, '.');
        $image_name = substr($filename, 0, $i);
        $ext = substr($filename, $i);

        // Set up the path
        $image_path = $dir . $filename;

        // Set up the write paths
        $image_path_pro = $dir . "profiles/" . $image_name . $ext;
        $image_path_feed = $dir . "thumbs/" . $image_name . $ext;

        self::resize_image($image_path, $image_path_pro, 225, 169);
        self::resize_image($image_path, $image_path_feed, 106, 80);
    }

    private function resize_image($old_image_path, $new_image_path,
            $max_width, $max_height) {

        // Get image type
        $image_info = getimagesize($old_image_path);
        $image_type = $image_info[2];

        // Set up the function names
        switch($image_type) {
            case IMAGETYPE_JPEG:
                $image_from_file = 'imagecreatefromjpeg';
                $image_to_file = 'imagejpeg';
                break;
            case IMAGETYPE_GIF:
                $image_from_file = 'imagecreatefromgif';
                $image_to_file = 'imagegif';
                break;
            case IMAGETYPE_PNG:
                $image_from_file = 'imagecreatefrompng';
                $image_to_file = 'imagepng';
                break;
            default:
                echo 'File must be a JPEG, GIF, or PNG image.';
                exit;
        }

        // Get the old image and its height and width
        $old_image = $image_from_file($old_image_path);
        $old_width = imagesx($old_image);
        $old_height = imagesy($old_image);

        // Calculate height and width ratios
        $width_ratio = $old_width / $max_width;
        $height_ratio = $old_height / $max_height;

        // If image is larger than specified ratio, create the new image
        if ($width_ratio > 1 || $height_ratio > 1) {

            // Calculate height and width for the new image
            $ratio = max($width_ratio, $height_ratio);
            $new_height = round($old_height / $ratio);
            $new_width = round($old_width / $ratio);

            // Create the new image
            $new_image = imagecreatetruecolor($new_width, $new_height);

            // Set transparency according to image type
            if ($image_type == IMAGETYPE_GIF) {
                $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
                imagecolortransparent($new_image, $alpha);
            }
            if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
                imagealphablending($new_image, false);
                imagesavealpha($new_image, true);
            }

            // Copy old image to new image - this resizes the image
            $new_x = 0;
            $new_y = 0;
            $old_x = 0;
            $old_y = 0;
            imagecopyresampled($new_image, $old_image,
                               $new_x, $new_y, $old_x, $old_y,
                               $new_width, $new_height, $old_width, $old_height);

            // Write the new image to a new file
            $image_to_file($new_image, $new_image_path);

            // Free any memory associated with the new image
            imagedestroy($new_image);
        } else {
            // Write the old image to a new file
            $image_to_file($old_image, $new_image_path);
        }
        // Free any memory associated with the old image
        imagedestroy($old_image);
    }
    
}
