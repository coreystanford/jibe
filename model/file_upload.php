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
        if(file_exists($file)) {
            $delete_result = unlink($file);
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
    
}
