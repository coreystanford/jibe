<?php include '../view/header.php'; ?>
<?php $allcountries = array(
    'Canada',
    'USA',
    'United Kingdom'
); 

?>
<section role=main>
			
    <div class="slim clearfix">
            <h1>Add a job</h1>

            <form action="?action=add_job" id="add-job" name="add-job" method="post" enctype="multipart/form-data">       
        <div class="left-column clearfix">
            <h4>Select Category</h4>
            <div class="job-drop-down">
                 <select name="job_cat">
                    <option value="allcategories">--Select Category--</option>
                     <?php 
                     foreach($allcategories as $category){
                         ($job_cat == $category->getID()) ? $attr_selected = 'selected = "selected"' : $attr_selected = '';
                        ?>
                     <option value="<?php echo $category->getID();?>" <?php echo $attr_selected;?> ><?php echo $category->getTitle();?></option>
                     
                     <?php
                     }
                     ?>
                 </select>
             </div>             
             
       </div>

        <div class="right-column clearfix">   
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
    <input type="hidden" name="job_date" value="<?php echo $job_date; ?>" />
    <br/>
    <label for="job_title" >Job Title: </label>
    <input type="text" name="job_title" class="job-text" value="<?php echo $job_title; ?>" />
    <br/>
    <label for="job_company" >Company Hiring: </label>
    <input type="text" name="job_company" class="job-text" value="<?php echo $job_company; ?>" />
    <br/>
    <label for="job_logo" >Company Logo: </label>
        <input type="file" name="job_logo" id="job_logo" >

    <br />
    <label for="job_city" >Job Location: </label>
    <input type="text" name="job_city" class="job-text" value="<?php echo $job_city; ?>" />
    <select name="job_country">
        <option value="allcountries">--Select Country---</option>
            <?php 
            foreach($allcountries as $country){
                ($job_country == $country) ? $attr_selected = 'selected = "selected"' : $attr_selected = '';
            ?>
            <option value="<?php echo $country;?>" <?php echo $attr_selected;?> ><?php echo $country;?></option>
                     
            <?php
            } // end foreach loop
            ?>
    </select>
    <br/>
    <label>Job Description: </label>
    <textarea type="text" name="job_description" class="job-textarea" value="<?php echo $job_description; ?>" cols="20" rows="10" >
    
    </textarea>
    
    
    </div>
        <input type="submit" name="submitjob" value="Submit" class="job-inline-button" />
             <input type="reset" name="resetjob" value ="Reset" class="job-inline-button" />
            </form>
            
    </div>
</section>
        <?php include '../view/footer.php'; ?>

