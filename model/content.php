<?php

class Content {

	private $id, $proj_id, $content, $attribute;

	public function __construct($proj_id, $content){
		$this->proj_id = $proj_id;
		$this->content = $content;
	}

	public function getID() {
        return $this->id;
    }

    public function setID($value) {
        return $this->id = $value;
    }

    public function getProjID() {
        return $this->proj_id;
    }

    public function setProjID($value) {
        return $this->proj_id = $value;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($value) {
        return $this->content = $value;
    }

}