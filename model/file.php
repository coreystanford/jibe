<?php

class File {

	private $id, $url, $tag, $attribute;

	public function __construct($url, $tag = '', $attribute = ''){
		$this->url = $url;
		$this->tag = $tag;
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

    public function getTag() {
        return $this->tag;
    }

    public function setTag($value) {
        return $this->tag = $value;
    }

    public function getAttribute() {
        return $this->attribute;
    }

    public function setAttribute($value) {
        return $this->attribute = $value;
    }

}
