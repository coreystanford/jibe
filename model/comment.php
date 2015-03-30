<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of comment
 *
 * @author ILecoche
 */
class Comment {
    //put your code here
    private $_cmt_id, $_user, $_proj, $_cmt_msg, $_cmt_date;
    
    public function __construct($user, $proj, $cmt_msg, $cmt_date) {
        $this->_user = $user;
        $this->_proj = $proj;
        $this->_cmt_msg = $cmt_msg;
        $this->_cmt_date = $cmt_date;
    }
    
    public function getID(){
        return $this->_cmt_id;
    }
    
    public function setID($value){
        $this->_cmt_id = $value;
    }
    
    public function getUser(){
        return $this->_user;
    }
    
    public function getProject(){
        return $this->_proj;
    }
    
    public function getComment(){
        return $this->_cmt_msg;
    }
    
    public function getDate(){
        return $this->_cmt_date;
    }
}
