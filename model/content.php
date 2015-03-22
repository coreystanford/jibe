<?php

class Content {

	private $id, $project, $content, $attribute;

	public function __construct($project, $content){
		$this->proj_id = $project;
		$this->content = $content;
	}

	public function getID() {
        return $this->id;
    }

    public function setID($value) {
        return $this->id = $value;
    }

    public function getProject() {
        return $this->project;
    }

    public function setProj($value) {
        return $this->project = $value;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($value) {
        return $this->content = $value;
    }

}