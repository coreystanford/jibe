<?php

class Validate {

	private $fields;

	public function __construct(){
		$this->fields = new Fields();
	}

	public function getFields(){
		return $this->fields;
	}

	// ------ Text Fields ------ //

	public function text($name, $value, $required = true, $min = 1, $max = 255) {

		$field = $this->fields->getField($name);

		if(!$required && empty($value)) {
			$field->clearErrorMessage();
			return;
		}

		if($required && empty($value)){
			$field->setErrorMessage('*Required');
		} else if(strlen($value) < $min){
			$field->setErrorMessage('Too short.');
		} else if(strlen($value) > $max){
			$field->setErrorMessage('Too long.');
		} else {
			$field->clearErrorMessage();
		}

	}

	// ------ Generic Validation Pattern ------ //

	public function pattern($name, $value, $pattern, $message, $required = true){

		$field = $this->fields->getField($name);

		if(!$required && empty($value)) {
			$field->clearErrorMessage();
			return;
		}

		$match = preg_match($pattern, $value);
		if($match === false) {
			$field->setErrorMessage('Error testing field.');
		} else if($match != 1){
			$field->setErrorMessage($message);
		} else {
			$field->clearErrorMessage();
		}

	}

	// ------ Phone Numbers ------ //

	public function phone($name, $value, $required = true){

		$field = $this->fields->getField($name);

		$this->text($name, $value, $required);
		if($field->hasError()){
			return;
		}

		$pattern = "/^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$/";

		$message = "Invalid phone number.";

		$this->pattern($name, $value, $pattern, $message, $required);

	}

	// ------ Lists - Dropdown (default as 'Select'), Radio, Multiple, Checkbox ------ //

	public function lists($name, $value) {

		$field = $this->fields->getField($name);

		if(empty($value) || $value == 'Select'){
			$field->setErrorMessage('*Required');
		} else {
			$field->clearErrorMessage();
		}

	}

}