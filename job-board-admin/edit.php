<?php include '../view/header.php'; ?>
<?php

// countries allowed for job postings-----------

$allcountries = array(
    'Canada',
    'USA',
    'United Kingdom'
);
?>
<section role=main>

    <div class="slim clearfix">


        <h1>Edit a job posting <?php echo $job_title; ?>
           
        </h1>
        
        <!---------- form to update a job listing ----------->

        <form action="?action=edit_job" id="edit-job" name="edit-job" method="post" enctype="multipart/form-data">       

        <!-- some hidden fields to store data populated from the code---------->
        
            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>" />
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
            <input type="hidden" name="job_date" value="<?php echo $job_date; ?>" />

            <ul class="job-form">
                <li>
                    <div class="job-form-label job-left">
                        <label for="job_cat" >Select Category: </label>
                    </div>
                    <div class="job-form-input job-right">
                        
        <!--------Select job category------------------------------------->
        
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
                    
        <!----job title------------------->
        
                    <div class="job-form-label job-left">
                        <label for="job_title" >Job Title: </label>
                    </div>
                    <div class="job-form-input job-right">
                        <input type="text" name="job_title" class="job-text" value="<?php echo $job_title; ?>" />
                        <?php echo $newjobfields->getField('job_title')->getHTML(); ?>
                    </div>
                </li>
                <li>
                    
        <!---------------Company hiring ---------------->
        
                    <div class="job-form-label job-left">
                        <label for="job_company" >Company Hiring: </label>  
                    </div>
                    <div class="job-form-input job-right">
                        <input type="text" name="job_company" class="job-text" value="<?php echo $job_company; ?>" />
                        <?php echo $newjobfields->getField('job_company')->getHTML(); ?>
                    </div>
                </li>  
                <li>
                    <div class="job-form-label job-left">
                        <label for="job_logo" >Company Logo: </label>
                    </div>
                    
        <!-----------updating company logo-------------------------->            
                    
                    <div class="job-form-input job-right">
                        <div class="job-logo">
                        <img src="../<?php echo $job_logo; ?>" />
                        </div>
                        <input type="hidden" name="job_logo" id="job_logo" value="<?php echo $job_logo; ?>" />
                        <input type="file" name="upd_job_logo" id="upd_job_logo" >
                        <?php echo $fileuploaderrors; ?>
                    </div>
                </li>
                <li>
                    
        <!------------Updating city---------------->
        
                    <div class="job-form-label job-left">
                        <label for="job_city" >City: </label>
                    </div>
                    <div class="job-form-input job-right">
                        <input type="text" name="job_city" class="job-text" value="<?php echo $job_city; ?>" />
                        <?php echo $newjobfields->getField('job_city')->getHTML(); ?>
                    </div>
                </li>
                
        <!-----------updating country------------------->
                
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
                
        <!----------updating job description ----------------------------->        
                
                <li>
                    <div class="job-form-label job-full">
                        <label for="job-description">Job Description: </label>
                        <br/>
                        <textarea type="text" name="job_description" class="job-textarea" >
                            <?php echo $job_description; ?>
                        </textarea>                
                        <?php echo $newjobfields->getField('job_description')->getHTML(); ?>
                    </div>
                </li>
            </ul>

        <div class="job-form-label job-left">
            <h1>
                <button type="submit" name="submitjob" class="fa fa-check job-inline-button"> </button>
            </h1>
        </div>
        </form>
        <div class="job-form-label job-right">
            <form method="post" action="?action=list_jobs" class="job-inline job-right">
                <h1>
                    <button type="submit" name="resetjob" value="Reset"  class="fa fa-remove job-inline-button job-right"> </button>
                </h1>
            </form>
        </div>



    </div>

</section>
<?php include '../view/footer.php'; ?>

