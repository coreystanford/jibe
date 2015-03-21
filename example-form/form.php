<?php 
    include '../view/header.php';

    if(!isset($_POST['submit'])){
        $fname = "";
        $lname = "";
        $email = "";
        $phone = "";
    }

    if(!isset($categoryList)){
        header('Location: ../example-form/');
    }

?>

    <section role=main>
        
        <div class="slim">

            <h1>Example Form</h1>

            <form method="post" action="." >
                <input type="hidden" name="action" value="example-submit" />

                <div class="cluster clearfix">

                    <label for="fname" class="bold-labels">First Name: </label>
                    <input type="text" name="fname" value="<?php echo htmlspecialchars($fname); ?>"><?php echo $fields->getField('fname')->getHTML(); ?>

                    <label for="lname" class="bold-labels">Last Name: </label>
                    <input type="text" name="lname" value="<?php echo htmlspecialchars($lname); ?>"><?php echo $fields->getField('lname')->getHTML(); ?>

                    <label for="email" class="bold-labels">E-mail: </label>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"><?php echo $fields->getField('email')->getHTML(); ?>

                    <label for="phone" class="bold-labels">Business Phone: </label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><?php echo $fields->getField('phone')->getHTML(); ?>

                    <label for="categoryDropdown" class="bold-labels">A Category Dropdown List (from DB): </label>
                    <?php echo displayList("categoryDropdown", $categoryList); ?><?php echo $fields->getField('categoryDropdown')->getHTML(); ?>

                    <label for="categoryRadio" class="bold-labels">A Category Radio Button List (from DB): </label>
                    <?php echo displayList("categoryRadio", $categoryList, 'radiolist'); ?><?php echo $fields->getField('categoryRadio')->getHTML(); ?>

                    <label for="categoryCheckbox" class="bold-labels">A Category Checkbox List (from DB): </label>
                    <?php echo displayList("categoryCheckbox", $categoryList, 'checkboxlist'); ?><?php echo $fields->getField('categoryCheckbox')->getHTML(); ?>

                </div>
                <div class="cluster clearfix">

                    <input type="submit" name="submit" value="Submit" class="btn submit" />
                    <a href="." class="btn submit">Cancel</a>
                
                </div>
            </form>

        </div>
    </section>
<?php include '../view/footer.php'; ?>
