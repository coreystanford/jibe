<?php

class Project {

	private $proj_id, $user_id, $cat_id, $title, $desc, $thumb, $featured;

	public function __construct($user_id, $cat_id, $title, $desc, $thumb, $featured = 0){
		$this->user_id = $user_id;
		$this->cat_id = $cat_id;
		$this->title = $title;
		$this->desc = $desc;
		$this->thumb = $thumb;
		$this->featured = $featured;
	}

	public function getID() {
        return $this->proj_id;
    }

    public function setID($value) {
        return $this->proj_id = $value;
    }

    public function getUser() {
        return $this->user_id;
    }

    public function setUser($value) {
        return $this->user_id = $value;
    }

    public function getCat() {
        return $this->cat_id;
    }

    public function setCat($value) {
        return $this->cat_id = $value;
    }

    public function getProjTitle() {
        return $this->title;
    }

    public function setProjTitle($value) {
        return $this->title = $value;
    }

    public function getProjDesc() {
        return $this->desc;
    }

    public function setProjDesc($value) {
        return $this->desc = $value;
    }

    public function getProjThumb() {
        return $this->thumb;
    }

    public function setProjThumb($value) {
        return $this->thumb = $value;
    }

    public function getFeatured() {
        return $this->featured;
    }

    public function setFeatured($value) {
        return $this->featured = $value;
    }

}
