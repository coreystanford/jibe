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
    public function getFilename(){
        return $this->_filename;
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

        self::resize_crop_image(225, 169, $image_path, $image_path_pro);
        self::resize_crop_image(106, 80, $image_path, $image_path_feed);
    }

    public function createNewProfileThumbs($filename, $dir = "../images_upload") {
        // Set up the variables
        $dir = $dir . DIRECTORY_SEPARATOR;
        $i = strrpos($filename, '.');
        $image_name = substr($filename, 0, $i);
        $ext = substr($filename, $i);

        // Set up the path
        $image_path = $dir . $filename;

        $pro_path = $dir . "profiles/" . $image_name . $ext;
        $thumb_path = $dir . "thumbs/" . $image_name . $ext;

        // Set up the write paths
        // Check for filename, auto-increment filename if name already exists
        if(file_exists($pro_path)){
            $i = 1;
            while(file_exists($pro_path)){
                $pro_path = $dir . "profiles/" . $image_name . $i . $ext;
                $thumb_path = $dir . "thumbs/" . $image_name . $i . $ext;

                $imgname = $image_name . $i . $ext;
                self::setFilename($imgname);

                $i++;
            }
        } else if (file_exists($thumb_path)) {
            $i = 1;
            while(file_exists($thumb_path)){
                $pro_path = $dir . "profiles/" . $image_name . $i . $ext;
                $thumb_path = $dir . "thumbs/" . $image_name . $i . $ext;

                $imgname = $image_name . $i . $ext;
                self::setFilename($imgname);

                $i++;
            }
        }

        self::resizeCropImage(225, 169, $image_path, $pro_path); // Profile Image
        self::resizeCropImage(106, 80, $image_path, $thumb_path); // Feed Thumbnail
    }

    // http://polyetilen.lt/en/resize-and-crop-image-from-center-with-php

    public function resizeCropImage($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];
     
        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;
     
            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;
     
            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;
     
            default:
                return false;
                break;
        }
         
        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);
         
        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }
         
        $image($dst_img, $dst_dir, $quality);
     
        if($dst_img)imagedestroy($dst_img);
        if($src_img)imagedestroy($src_img);
    }
    
}
