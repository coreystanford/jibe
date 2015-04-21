<?php

// -- Index -- //

// -- A -- pattern(4-5) - Generic Regex Validation
// -- B -- filter(4-5) - Generic PHP Validation Filters
// -- C -- text(2-5) - Text Fields
//      -- 1 -- lists(2) - Dropdown, Radio, Multiple, Checkboxes
//      -- 2 -- range(4-5) - Ranges
//      -- 3 -- username(2-3) - Username Regex
//      -- 4 -- password(2-3) - Password Regex
//      -- 5 -- confirmPassword(3-4) - Confirm Password
//      -- 6 -- name(2-3) - Name Regex
//      -- 7 -- phone(2-3) - Phone Numbers Regex
//      -- 8 -- address(2-3) - Address Regex
//      -- 9 -- postal(2-3) - Postal Code Regex
//      -- 10 -- slug(2-3) - Slug Regex
//      -- 11 -- email(2-3) - Email Filter
//      -- 12 -- url(2-3) - URL Filter
//      -- 13 -- upload(2-5) - File Upload

class Validate {

	private $fields;

	public function __construct(){
		$this->fields = new Fields();
	}

	public function getFields(){
		return $this->fields;
	}

	// -- A --//
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

	// -- B --//
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

	// -- C --//
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

	// -- 1 --//
	// ------ Lists - Dropdown (default as 'Select'), 
	//		  Radio, Multiple, Checkbox ------ //

	public function lists($name, $value, $default_value = 'Select') {

		$field = $this->fields->getField($name);

		if(empty($value) || $value == $default_value){
			$field->setErrorMessage('Required');
		} else {
			$field->clearErrorMessage();
		}

	}

	// -- 2 --//
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

	// -- 3 --//
	// ------ Username Regex ------ //

	public function username($name, $value, $required = true){

		$field = $this->fields->getField($name);

		$this->text($name, $value, $required);
		if($field->hasError()){
			return;
		}

		$pattern = "/^[a-z0-9_-]{3,16}$/";

		//Source http://code.tutsplus.com/tutorials/8-regular-expressions-you-should-know--net-6149

		$message = "Invalid Username";

		$this->pattern($name, $value, $pattern, $message, $required);

	}

	// -- 4 --//
	// ------ Password Regex ------ //

	// 		8 characters
	//		at least one letter
	//		at least one number
	//		at least one special character

	public function password($name, $value, $required = true){

		$field = $this->fields->getField($name);

		$this->text($name, $value, $required);
		if($field->hasError()){
			return;
		}

		//$pattern = "/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&? ']).*$/";
                $pattern = "/^[a-zA-Z]\w{3,14}$/";

			// ^.*              : Start
			// (?=.{8,})        : Length
			// (?=.*[a-zA-Z])   : Letters
			// (?=.*\d)         : Digits
			// (?=.*[!#$%&? "]) : Special characters
			// .*$              : End

			// Source http://stackoverflow.com/questions/2370015/regular-expression-for-password-validation

		$message = "Please enter a strong password";

		$this->pattern($name, $value, $pattern, $message, $required);

	}

	// -- 5 --//
	// ------ Confirm Password ------ //

	public function confirmPassword($name, $otherField, $thisField, $required = true){

		$field = $this->fields->getField($name);

		$this->text($name, $otherField, $required);
		if($field->hasError()){
			return;
		}

		$this->text($name, $thisField, $required);
		if($field->hasError()){
			return;
		}

		if($required && empty($thisField)){
			$field->setErrorMessage('Required');
		} else if ($otherField != $thisField) {
			$field->setErrorMessage("Password Does Not Match");
		} else {
			$field->clearErrorMessage();
		}

	}

	// -- 6 --//
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

	// -- 7 --//
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

	// -- 8 --//
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

	// -- 9 --//
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

	// -- 10 --//
	// ------ Slug Regex ------ //

	public function slug($name, $value, $required = true){

		$field = $this->fields->getField($name);

		$this->text($name, $value, $required);
		if($field->hasError()){
			return;
		}

		$pattern = "/^[a-z0-9-]+$/";

		$message = "Invalid Slug";

		$this->pattern($name, $value, $pattern, $message, $required);

	}

	// -- 11 --//
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

	// -- 12 --//
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

	// -- 13 --//
	// ------ File Upload ------ //

	public function upload($name, $value, $required = true, $max_size = '3145728', $ext = array('jpg', 'gif', 'png', 'jpeg')) {

		$field = $this->fields->getField($name);

		if(!$required && empty($value['name'])) {
			$field->clearErrorMessage();
			return;
		}

		if($required && empty($value['name'])){

			$field->setErrorMessage('Required');
			
		} else if($value['size'] > $max_size){

			$field->setErrorMessage('File size is too large.');
			
		} else if(!in_array($this->getExtension($value), $ext)){

			$field->setErrorMessage('Incorrect file type');
			
		} else {

			$field->clearErrorMessage();

		}

	}
		// ------ File Upload - Helper ------ //
	
		public function getExtension($value){
	        $filename_full = $value['name'];
	        $extension = pathinfo($filename_full, PATHINFO_EXTENSION);
	        return $extension;
	    }

}