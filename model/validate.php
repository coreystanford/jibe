<?php

// -- Index -- //

//  pattern(4-5) - Generic Regex Validation
//  filter(4-5) - Generic PHP Validation Filters
//  text(2-5) - Text Fields
//    lists(2) - Dropdown, Radio, Multiple, Checkboxes
//    range(4-5) - Ranges
//    name(2-3) - Name Regex
//    phone(2-3) - Phone Numbers Regex
//    address(2-3) - Address Regex
//    postal(2-3) - Postal Code Regex
//    email(2-3) - Email Filter
//    url(2-3) - URL Filter

class Validate {

	private $fields;

	public function __construct(){
		$this->fields = new Fields();
	}

	public function getFields(){
		return $this->fields;
	}

	// ------ Generic Regex Validation ------ //

	public function pattern($name, $value, $pattern, $message, $required = true){

		$field = $this->fields->getField($name);

		if(!$required && empty($value)) {
			$field->clearErrorMessage();
			return;
		}

		$match = preg_match($pattern, $value);
		if($match === false) {
			$field->setErrorMessage('Uh oh, error testing this field!');
		} else if($match != 1){
			$field->setErrorMessage($message);
		} else {
			$field->clearErrorMessage();
		}

	}

	// ------ Generic PHP Validation Filters ------ //

	public function filter($name, $value, $filter, $message, $required = true){

		$field = $this->fields->getField($name);

		if(!$required && empty($value)) {
			$field->clearErrorMessage();
			return;
		}

		if(!filter_var($value, $filter)) {
			$field->setErrorMessage($message);
		} else {
			$field->clearErrorMessage();
		}

	}

	// ------ Text Fields ------ //

	public function text($name, $value, $required = true, $min = 1, $max = 255) {

		$field = $this->fields->getField($name);

		if(!$required && empty($value)) {
			$field->clearErrorMessage();
			return;
		}

		if($required && empty($value)){
			$field->setErrorMessage('Required');
		} else if(strlen($value) < $min){
			$field->setErrorMessage('Too Short');
		} else if(strlen($value) > $max){
			$field->setErrorMessage('Too Long');
		} else {
			$field->clearErrorMessage();
		}

	}

	// ------ Lists - Dropdown (default as 'Select'), Radio, Multiple, Checkbox ------ //

	public function lists($name, $value) {

		$field = $this->fields->getField($name);

		if(empty($value) || $value == 'Select'){
			$field->setErrorMessage('Required');
		} else {
			$field->clearErrorMessage();
		}

	}

	// ------ Ranges ------ //

	public function range($name, $value, $min, $max, $required = true){

		$field = $this->fields->getField($name);

		if(!$required && empty($value)){
			$field->clearErrorMessage();
			return;
		}

		if($required && empty($value)){
			$field->setErrorMessage('Required');
		} else if ($value < $min) {
			$field->setErrorMessage('Please enter a number over '.$min);
		} else if ($value > $max){
			$field->setErrorMessage('Please enter a number under '.$max);
		} else {
			$field->clearErrorMessage();
		}

	}

	// ------ Name Regex ------ //

	public function name($name, $value, $required = true){

		$field = $this->fields->getField($name);

		$this->text($name, $value, $required);
		if($field->hasError()){
			return;
		}

		$pattern = "/^[a-zA-Z]+(([\s\'\,\.\-][a-zA-Z])?[a-zA-Z]*)*$/";

		$message = "Invalid Name";

		$this->pattern($name, $value, $pattern, $message, $required);

	}

	// ------ Phone Numbers Regex ------ //

	public function phone($name, $value, $required = true){

		$field = $this->fields->getField($name);

		$this->text($name, $value, $required);
		if($field->hasError()){
			return;
		}

		$pattern = "/^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$/";

		$message = "Invalid Phone Number";

		$this->pattern($name, $value, $pattern, $message, $required);

	}

	// ------ Address Regex ------ //

	public function address($name, $value, $required = true){

		$field = $this->fields->getField($name);

		$this->text($name, $value, $required);
		if($field->hasError()){
			return;
		}

		$pattern = "/^\d{1,5}.?\d{0,3}\s[a-zA-Z0-9]{2,30}\s[a-zA-Z]{2,15}\.?$/";

		$message = "Invalid Address";

		$this->pattern($name, $value, $pattern, $message, $required);

	}

	// ------ Postal Code Regex ------ //

	public function postal($name, $value, $required = true){

		$field = $this->fields->getField($name);

		$this->text($name, $value, $required);
		if($field->hasError()){
			return;
		}

		$pattern = "/^([ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ])\ {0,1}(\d[ABCEGHJKLMNPRSTVWXYZ]\d)$/";

		$message = "Invalid Postal Code";

		$this->pattern($name, $value, $pattern, $message, $required);

	}

	// ------ Email Filter ------ //

	public function email($name, $value, $required = true){

		$field = $this->fields->getField($name);

		$this->text($name, $value, $required);
		if($field->hasError()){
			return;
		}

		$filter = FILTER_VALIDATE_EMAIL;

		$message = "Invalid Email";

		$this->filter($name, $value, $filter, $message, $required);

	}

	// ------ URL Filter ------ //

	public function url($name, $value, $required = true){

		$field = $this->fields->getField($name);

		$this->text($name, $value, $required);
		if($field->hasError()){
			return;
		}

		$filter = FILTER_VALIDATE_URL;

		$message = "Invalid URL.";

		$this->filter($name, $value, $filter, $message, $required);

	}

}