<?php include  '../view/header.php'; ?>
<?php
$allcountries = array(
    'Canada',
    'USA',
    'United Kingdom'
);
?>
<section role=main>

    <div class="slim clearfix">

        <h1>Add a job</h1>
        
        <?php if(isset($_GET['id'])): ?>
            
            <form action="?action=add_job&id=<?php echo $_GET['id']; ?>" id="add-job" name="add-job" method="post" enctype="multipart/form-data">       
                
            <?php else: ?>
 
            <form action="?action=add_job" id="add-job" name="add-job" method="post" enctype="multipart/form-data">       

            <?php endif; ?>


            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
            <input type="hidden" name="job_date" value="<?php echo $job_date; ?>" />
            <ul class="job-form">
                <li>
                    <div class="job-form-label job-left">
                        <label for="job_cat" >Select Category: </label>
                    </div>
                    <div class="job-form-input job-right">
                        <select name="job_cat">
                            <option value="allcategories">--Select Category--</option>
                            <?php
                            foreach ($allcategories as $category) {
                                ($job_cat == $category->getID()) ? $attr_selected = 'selected = "selected"' : $attr_selected = '';
                                ?>
                                <option value="<?php echo $category->getID(); ?>" <?php echo $attr_selected; ?> ><?php echo $category->getTitle(); ?></option>

                                <?php
                            }
                            ?>
                        </select> 
                        <?php echo $newjobfields->getField('job_cat')->getHTML(); ?>
                    </div>       
                </li>
                <li>
                    <div class="job-form-label job-left">
                        <label for="job_title" >Job Title: </label>
                    </div>
                    <div class="job-form-input job-right">
                        <input type="text" name="job_title" class="job-text" value="<?php echo htmlspecialchars($job_title); ?>" />
                        <?php echo $newjobfields->getField('job_title')->getHTML(); ?>

                    </div>
                </li>
                <li>
                    <div class="job-form-label job-left">
                        <label for="job_company" >Company Hiring: </label>  
                    </div>
                    <div class="job-form-input job-right">
                        <input type="text" name="job_company" class="job-text" value="<?php echo htmlspecialchars($job_company); ?>" />
                        <?php echo $newjobfields->getField('job_company')->getHTML(); ?>
                    </div>
                </li>
                <li>
                    <div class="job-form-label job-left">
                        <label for="job_logo" >Company Logo (recommended size 100px X 100px) : </label>
                    </div>
                    <div class="job-form-input job-right">
                        <input type="file" name="job_logo" id="job_logo" >
                        <?php echo $fileuploaderrors; ?>
                    </div>
                <li>
                    <div class="job-form-label job-left">
                        <label for="job_city" >City: </label>
                    </div>
                    <div class="job-form-input job-right">
                        <input type="text" name="job_city" class="job-text" value="<?php echo htmlspecialchars($job_city); ?>" />
                        <?php echo $newjobfields->getField('job_city')->getHTML(); ?>
                    </div>
                </li>
                <li>
                    <div class="job-form-label job-left">
                        <label for="job_country" >Country: </label>
                    </div>
                    <div class="job-form-input job-right">
                        <select name="job_country">
                            <option value="allcountries">--Select Country---</option>
                            <?php
                            foreach ($allcountries as $country) {
                                ($job_country == $country) ? $attr_selected = 'selected = "selected"' : $attr_selected = '';
                                ?>
                                <option value="<?php echo $country; ?>" <?php echo $attr_selected; ?> ><?php echo $country; ?></option>

                                <?php
                            } // end foreach loop
                            ?>
                        </select>
                        <?php echo $newjobfields->getField('job_country')->getHTML(); ?>

                    </div>
                </li>
                <li>
                    <div class="job-form-label job-full">
                        <label for="job_description">Job Description: </label>
                        <br/>
                        <textarea type="text" name="job_description" class="job-textarea" >
                            <?php echo htmlspecialchars($job_description); ?>
                        </textarea>   
                        <?php echo $newjobfields->getField('job_description')->getHTML(); ?>

                    </div>
                </li>
            </ul>    
            <h1>
                <button type="submit" name="submitjob" class="fa fa-check job-inline-button"> </button>
            </h1>
        </form>
        <form method="post" action="?action=list_jobs" class="job-inline">
            <h1>
                <button type="submit" name="resetjob" value="Reset"  class="fa fa-remove job-inline-button"> </button>
            </h1>
    </div>
</section>
<?php include '../view/footer.php'; ?>

