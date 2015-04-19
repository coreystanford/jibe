<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Like
 *
 * @author ILecoche
 */
class Like {
    
    //put your code here
    
    private $_like_id, $_user, $_project;
    
    public function __construct($user, $proj) {
        $this->_user = $user;
        $this->_project = $proj;
    }
    
    public function getID(){
        return $this->_like_id;
    }
    
    public function setID($value){
        $this->_like_id = $value;
    }
    
    public function getUser(){
        return $this->_user;
    }
    
    public function getProject(){
        return $this->_project;
    }
}
