<?php

class File {

	private $id, $url, $attribute;

	public function __construct($url, $attribute = ''){
		$this->url = $url;
		$this->attribute = $attribute;
	}

	public function getID() {
        return $this->id;
    }

    public function setID($value) {
        return $this->id = $value;
    }

    public function getURL() {
        return $this->url;
    }

    public function setURL($value) {
        return $this->url = $value;
    }

    public function getAttribute() {
        return $this->attribute;
    }

    public function setAttribute($value) {
        return $this->attribute = $value;
    }

}
