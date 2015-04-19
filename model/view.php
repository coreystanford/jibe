<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author ILecoche
 */
class View {
    //put your code here
    private $_view_id, $_project_id, $_num_views;
    
    public function __construct($project_id, $num_views) {
        
        $this->_project_id = $project_id;
        $this->_num_views;
    }
    
    public function getID(){
        $this->_view_id;
    }
    
    public function setID($id){
        $this->_view_id = $id;
    }
    
   
}
