<?php

/**
 * Description of sliderImage
 *
 * @author Wilston
 */
class SliderImage {
    private $id, $user_id, $img_name;
    
    public function __construct($user_id,$img_name) {
        $this->user_id = $user_id;
        $this->img_name = $img_name;
    }
    
    public function getID() {
        return $this->id;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
    
    public function getUserID() {
        return $this->user_id;
    }
    
    public function setUserID($user_id) {
        $this->user_id = $user_id;
    }
    
    public function getImgName() {
        return $this->img_name;
    }
    
    public function setImgName($img_name) {
        $this->img_name = $img_name;
    }
}
