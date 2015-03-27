<?php 
    require_once '../model/autoload.php';

    // -------------------------------------- //
    // ------ Determine Current Action ------ //
    // -------------------------------------- //

    // ------ POST ------ //

    if (isset($_POST['action'])) {
	    $action = $_POST['action'];
	} 

	// ------ GET ------ //

	else if (isset($_GET['action'])) {
	    $action = $_GET['action'];
	} 

	// ------ DEFAULT ------ //

	else {
	    $action = 'default';
	}

    // ------------------------------------- //
    // ------ Setup Validation Fields ------ //
    // ------------------------------------- //

    $validate = new Validate;
    $fields = $validate->getFields();
    $fields->addField('fname');
    $fields->addField('lname');
    $fields->addField('email');
    $fields->addField('phone');
    $fields->addField('categoryDropdown');
    $fields->addField('categoryRadio');
    $fields->addField('categoryCheckbox');

    // ---------------------------- //
    // ------ Perform Switch ------ //
    // ---------------------------- //

    switch ($action){
        
        // ------ Show Application Form (Default) ------ //

        case 'default':

            $categories = CategoryDB::getCategories();

            $categoryList = array();

            foreach ($categories as $category) {
                $cat = $category->getTitle();
                $categoryList[] = $cat;
            }

            include 'form.php';

        break;

        // ------ Perform Validation/Insert New Applicant ------ //

        case 'example-submit':

            // ------ Assign Posted Values ------ //

            $fname = trim($_POST['fname']);
            $lname = trim($_POST['lname']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $categoryDropdown = $_POST['categoryDropdown'];
            $categoryRadio = "";
            if(isset($_POST['categoryRadio'])){ $categoryRadio = $_POST['categoryRadio'];}
            $categoryCheckbox = "";
            if(isset($_POST['categoryCheckbox'])){ $categoryCheckbox = $_POST['categoryCheckbox'];}

            // ------ Validate Values ------ //

            $validate->name('fname', $fname);
            $validate->name('lname', $lname);
            $validate->email('email', $email);
            $validate->phone('phone', $phone);
            $validate->lists('categoryDropdown', $categoryDropdown);
            $validate->lists('categoryRadio', $categoryRadio);
            $validate->lists('categoryCheckbox', $categoryCheckbox);

            // ------ Check for Errors ------ //

            if($fields->hasErrors()){

                // ------ Deny - Reshow form (with values) ------ //

                $categories = CategoryDB::getCategories();

                $categoryList = array();

                foreach ($categories as $category) {
                    $cat = $category->getTitle();
                    $categoryList[] = $cat;
                }

                include 'form.php';

            } else {

                // ------ Process + Redirect ------ //

                /*
                Perform some kind of database interaction here
                */
                include 'thanks.php';

            }

        break;
    }
