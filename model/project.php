<?php

class Project {

	private $proj_id, $user_id, $cat_id, $title, $desc, $thumb, $date, $featured;

	public function __construct($user_id, $cat_id, $title, $desc, $thumb, $date, $featured){
		$this->user_id = $user_id;
		$this->cat_id = $cat_id;
		$this->title = $title;
		$this->desc = $desc;
		$this->thumb = $thumb;
		$this->date = $date;
		$this->featured = $featured;
	}

	public function getProjID() {
        return $this->proj_id;
    }

    public function setProjID($value) {
        return $this->proj_id = $value;
    }

    public function getUserID() {
        return $this->user_id;
    }

    public function setUserID($value) {
        return $this->user_id = $value;
    }

    public function getCatID() {
        return $this->cat_id;
    }

    public function setCatID($value) {
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

    public function getProjDate() {
        return $this->date;
    }

    public function setProjDate($value) {
        return $this->date = $value;
    }

    public function getFeatured() {
        return $this->featured;
    }

    public function setFeatured($value) {
        return $this->featured = $value;
    }

}
