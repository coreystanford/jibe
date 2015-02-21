<?php





// !!!!!!!! This should be revised before being incorporated !!!!!!!!!! 





// Add a new field by using:

//	addField(
//		"type of validator",  
//		$_POST['example"], 
//		"field label",
//		required?[true|false] DEFAULT = true
//	);
//

//	addRange(
//		"type of validator",  
//		$_POST['example"], 
//		"field label",
//		minumim value (int),
//		maximum value (int),
//		required?[true|false] DEFAULT = true
//	);

// Validation terms to use:
//
// - "" 			- denotes a field that is ONLY required
// - name 			- only allows letters
// - number 		- only allows numbers
// - email 			- validates emails
// - phone 			- validates phone numbers
// - address 		- checks for valid addresses
// - postal 	 	- checks for valid postal codes and zip codes
// - province 		- verifys province codes
// - multiple 		- for a list that can have multiple items selected (outputs unordered list)
// - radio 			- checks for value in radio button list
// - dropdown 		- checks against empty string or keyword 'Select'
// - range 			- validates a user-defined range of numbers


// ------- Class to hold new field values --------

class validateObj{
	var $validator;
	var $input;
	var $name;
	var $required;
}

// ------- Class to hold new range values --------

class validateObjRange{
	var $validator;
	var $input;
	var $name;
	var $minumum;
	var $maximum;
	var $required;
}

// --------------------------------------
// ------- Main Validation Class --------
// --------------------------------------

class validate {

	var $toValidate;
    var $errors;

    // Constructor - instantiate validation and error arrays

    public function __construct(){
    	$this->toValidate = array();
    	$this->errors = array();
    }

	// --------------------------------------
    // ------- Add Field to Validate --------
	// --------------------------------------

    public function addField($val, $in, $n, $req = true){
    	$formField = new validateObj();
    	$formField->validator = $val;
    	$formField->input = $in;
    	$formField->name = $n;
    	$formField->required = $req;
    	array_push($this->toValidate, $formField);
    }

    public function addRange($val, $in, $n, $minval, $maxval, $req = true){
    	$formField = new validateObjRange();
    	$formField->validator = $val;
    	$formField->input = $in;
    	$formField->name = $n;
    	$formField->minumum = $minval;
    	$formField->maximum = $maxval;
    	$formField->required = $req;
    	array_push($this->toValidate, $formField);
    }

	// ----------------------------------------
    // ------- Display Array of Errors --------
	// ----------------------------------------

    public function displayErrors()
    {
    	echo "<div class='exampleForm'>";
    	foreach($this->errors as $key=>$value){
    		echo $value;
    	}
    	echo "</div>";
    }

    // -------------------------------------------
    // ------- Display Summary of Content --------
	// -------------------------------------------

    public function displaySummary()
    {
    	echo "<div class='summary'>";
    		echo "<h2>Summary</h2><ul>";
		    	foreach($this->toValidate as $key=>$value){
		    		if($value->validator == 'multiple'){
		    			echo "<ul><p>".$value->name.": </p>";
				           foreach ($value->input as $in){
				                echo "<li>".$in."</li>";
				           }
			           echo "</ul>";
		    		}
		    		else
		    		{
		    			echo "<li><p>".$value->name.": ".$value->input."</p>";
		    		}
		    	}
    		echo "</ul>";
    	echo "</div>";
    }

    // --------------------------------------
    // ---------- Form Validation -----------
	// --------------------------------------

    public function validateForm(){

    	$valid = array();
    	$passed = true;
    	$validated;

    	// ------- Regular Expressions --------

    	$nameReg = "/^[a-zA-Z]+(([\s\'\,\.\-][a-zA-Z])?[a-zA-Z]*)*$/";
		$addressReg = "/^\d{1,5}.?\d{0,3}\s[a-zA-Z0-9]{2,30}\s[a-zA-Z]{2,15}\.?$/";
		$provinceReg = "/^[a-zA-Z]+(\s[a-zA-Z]+)?$/";
		$phoneReg = "/^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$/";
		$postalReg = "/^([ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ])\ {0,1}(\d[ABCEGHJKLMNPRSTVWXYZ]\d)$/";

		// --------------------------------------
	    // ---------- Main Validation -----------
		// --------------------------------------

    	foreach($this->toValidate as $key => $value){

    		// ------- Check Required Fields --------

			if($value->required == true){
				if($value->input == "" || is_null($value->input) || $value->input == "Select"){
					array_push($this->errors, "<p class='error'>". $value->name ." is required</p>");
					$passed = false;
					array_push($valid, false);
				}
				else {
					array_push($valid, true);
				}
			}

			// ------- Check RegEx and All Other Controls --------

			if($passed == true){

	            switch ($value->validator) {

	                case 'name':
	                    if(preg_match($nameReg, $value->input)){
				            array_push($valid, true);
				        }
				        else
				        {
				        	array_push($this->errors, "<p class='error'>Please enter a correct name for ".$value->name."</p>");
				        	array_push($valid, false);
				        }
	                    break;

	                case 'number':
	                    if(is_numeric($value->input)){
				            array_push($valid, true);
				        }
				        else
				        {
				        	array_push($this->errors, "<p class='error'>Please enter a number for ".$value->name."</p>");
				        	array_push($valid, false);
				        }
	                    break;

	                case 'email':
	                    if(filter_var($value->input, FILTER_VALIDATE_EMAIL)){
				           	array_push($valid, true);
				        }
				        else
				        {
				        	array_push($this->errors, "<p class='error'>Please enter a correct email</p>");
				        	array_push($valid, false);
				        }
	                    break;

	                case 'phone':
	                    if(preg_match($phoneReg, $value->input)){
				           	array_push($valid, true);
				        }
				        else
				        {
				        	array_push($this->errors, "<p class='error'>Please enter a correct phone number</p>");
				        	array_push($valid, false);
				        }
	                    break;

	                case 'dropdown':
	                    if($value->input == "Select" || empty($value->input) || $value->input == ""){
							array_push($this->errors, "<p class='error'>Please select from the dropdown: ".$value->name."</p>");
				        	array_push($valid, false);
				        }
				        else
				        {
				        	array_push($valid, true);
				        }
	                    break;

	                case 'radio':
	                    if(isset($value->input)){
				        	array_push($valid, true);
				        }
				        else
				        {
				        	array_push($this->errors, "<p class='error'>Please select from: ".$value->name."</p>");
				        	array_push($valid, false);
				        }
	                    break;

	                case 'multiple':
	                    if(isset($value->input)){
				        	array_push($valid, true);
				        }
				        else
				        {
				        	array_push($this->errors, "<p class='error'>Please select from: ".$value->name."</p>");
				        	array_push($valid, false);
				        }
	                    break;

	                case 'address':
	                    if(preg_match($addressReg, $value->input)){
							array_push($valid, true);
				        }
				        else
				        {
				        	array_push($this->errors, "<p class='error'>Please enter a valid address</p>");
				        	array_push($valid, false);
				        }
	                    break;

	                case 'postal':
	                    if(preg_match($postalReg, strtoupper($value->input))){
							array_push($valid, true);
				        }
				        else
				        {
				        	array_push($this->errors, "<p class='error'>Please enter a correct Postal Code</p>");
				        	array_push($valid, false);
				        }
	                    break;

	                case 'province':
	                    if(!preg_match($provinceReg, $value->input)){
							array_push($this->errors, "<p class='error'>Please enter a Province/State (eg. ON)</p>");
				        	array_push($valid, false);
				        }
				        else
				        {
				        	array_push($valid, true);
				        }
	                    break;

	                case 'range':
	                    if(is_numeric($value->input)){
	                    	if($value->input < $value->minumum || $value->input > $value->maximum){
								array_push($this->errors, "<p class='error'>Please enter a number between ".$value->minumum." and ".$value->maximum." for: ".$value->name."</p>");
					        	array_push($valid, false);
							} 
							else 
							{
								array_push($valid, true);
							}
				        }
				        else
				        {
				        	array_push($this->errors, "<p class='error'>Please enter a number for: ".$value->name."</p>");
				        	array_push($valid, false);
				        }
	                    break;

	                default:
	                    array_push($valid, true);
	                    break;
	            }
	        }
	    }

	    // ------- Check the $valid array for any falsehood --------

	    if(in_array(false, $valid)){
	    	$validated = false;
    	}
    	else{
    		$validated = true;
    	}

		// ------- Output Result --------

	    return $validated;

    }
}

?>