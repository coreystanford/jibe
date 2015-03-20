<?php

class Category {

    private $id, $title, $desc, $icon, $count;

    public function __construct($title, $desc = '', $icon = '<i class="fa fa-question"></i>'){
		$this->title = $title;
		$this->desc = $desc;
		$this->icon = $icon;
	}

    public function getID() {
        return $this->id;
    }

    public function setID($value) {
        return $this->id = $value;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($value) {
        return $this->title = $value;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($value) {
        return $this->desc = $value;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function setIcon($value) {
        return $this->icon = $value;
    }

    public function getProjCount() {
        return $this->count;
    }

    public function setProjCount($value) {
        return $this->count = $value;
    }

}
