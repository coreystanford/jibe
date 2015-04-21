<?php

class User {

	private $id, $fname, $lname, $city, $country, $website, $img_url, $bio, $specialty, $email;

	public function __construct($fname, $lname, $city = '', $country = '', $website = '', $img_url = 'default.jpg', $bio = '', $specialty = ''){
		$this->fname = $fname;
		$this->lname = $lname;
		$this->city = $city;
        $this->country = $country;
        $this->website = $website;
        $this->img_url = $img_url;
        $this->bio = $bio;
        $this->specialty = $specialty;
	}

	public function getID() {
        return $this->id;
    }

    public function setID($value) {
        return $this->id = $value;
    }

    public function getFName() {
        return $this->fname;
    }

    public function setFName($value) {
        return $this->fname = $value;
    }

    public function getLName() {
        return $this->lname;
    }

    public function setLName($value) {
        return $this->lname = $value;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($value) {
        return $this->city = $value;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($value) {
        return $this->country = $value;
    }

    public function getWebsite() {
        return $this->website;
    }

    public function setWebsite($value) {
        return $this->website = $value;
    }

    public function getImgURL() {
        return $this->img_url;
    }

    public function setImgURL($value) {
        return $this->img_url = $value;
    }

    public function getBio() {
        return $this->bio;
    }

    public function setBio($value) {
        return $this->bio = $value;
    }

    public function getSpecialty() {
        return $this->specialty;
    }

    public function setSpecialty($value) {
        return $this->specialty = $value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        return $this->email = $value;
    }

}