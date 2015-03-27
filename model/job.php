<?php


/**
 * Description of job
 *
 * @author ILecoche
 */
class Job {
    
    private $job_id, $user, $category, $job_title, $job_description, $job_company, $logo_url, $job_city, $job_country, $job_date;
    
    public function __construct($_user, $_category, $_job_title, $_job_description, $_job_company, $_logo_url, $_job_city, $_job_country, $_job_date) {
        $this->user = $_user;
        $this->category = $_category;
        $this->job_title = $_job_title;
        $this->job_description = $_job_description;
        $this->job_company = $_job_company;
        $this->logo_url = $_logo_url;
        $this->job_city = $_job_city;
        $this->job_country = $_job_country;
        $this->job_date = $_job_date;
    }
    
    public function getID(){
        return $this->job_id;
    }
    
    public function setID($value){
        $this->job_id = $value;
    }
    
    public function getUser(){
        return $this->user;
    }
    
    public function getJobCategory(){
        return $this->category;
    }
    
    public function setJobCategory($value){
        $this->category = $value;
    }
    
    public function getJobTitle(){
        return $this->job_title;
    }
    
    public function getJobDescription(){
        return $this->job_description;
    }
    
    public function getJobCompany(){
        return $this->job_company;
    }
    
    public function getLogoUrl(){
        return $this->logo_url;
    }
    
    public function getJobCity(){
        return $this->job_city;
    }
    
    public function getJobCountry(){
        return $this->job_country;
    }
    
    public function getJobDate(){
        $date = new DateTime($this->job_date);
        return $date->format('Y-m-d');
    }

}
