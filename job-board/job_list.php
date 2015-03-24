<?php include '../view/header.php'; ?>

<section role=main>

    <div class="slim clearfix">
        <p><?php echo $message_success; ?><?php echo $message_fail; ?></p>

        <div class="job-filters clearfix job-left" >

            <form id="filter-jobs" name="filter-jobs" method="post" action="?action=list_jobs">
                    <h4 class="job-inline">Filter results</h4>
                <div class="job-drop-down">
                    <select name="categories" id="categories" >
                        <option value="allcategories">--Select Category--</option>
                        <?php
                        foreach ($categories as $category) :
                            ($job_cat == $category->getID()) ? $attr_selected = 'selected = "selected"' : $attr_selected = '';
                            ?>
                            <option value="<?php echo $category->getID(); ?>" <?php echo $attr_selected; ?> ><?php echo $category->getTitle(); ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>             
               
                <div class="job-drop-down">
                    <select name="cities" id="cities" >
                        <option value="allcities">--Select City---------</option>
                        <?php
                        foreach ($cities as $city) {
                            ($job_city == $city) ? $attr_selected = 'selected = "selected"' : $attr_selected = '';
                            ?>
                            <option value="<?php echo $city; ?>" <?php echo $attr_selected; ?> ><?php echo $city; ?></option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="job-drop-down">
                    <select name="countries" id="countries">
                        <option value="allcountries">--Select Country---</option>
                        <?php
                        foreach ($countries as $country) {
                            ($job_country == $country) ? $attr_selected = 'selected = "selected"' : $attr_selected = '';
                            ?>
                            <option value="<?php echo $country; ?>" <?php echo $attr_selected; ?> ><?php echo $country; ?></option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                    <input type="submit" name="submitfilter" id="submitfilter" value="Filter" class="job-hidden" />
                    <button type="submit" name="resetfilter" class="fa fa-remove fa-lg job-button-clear" title="Remove filters">
                            
                        </button>
            </form>
            
         </div><!--end filters div -->
<!--        <div class="job-filters clearfix job-left" >
           <form method="post" class="job-inline job-right">
            <button type="submit" name="resetfilter" value ="Reset" class="fa fa-remove job-inline-button job-right"></button>
            </form>
        </div>-->
        
         <div class="job-container" >
            
                <?php foreach ($jobs as $job) : ?>
                    <div class="jobrow">
                        <span style="background: url('../<?php echo $job->getLogoUrl(); ?>') 50% 50%; width: 70px; display: block; background-size: cover;">
                            &nbsp;
                            <?php //echo $job->getJobCategory()->getIcon(); ?>
                        </span>
                        <div class="job-title-options">
                            
                            <h2><?php echo $job->getJobTitle(); ?></h2>
                            <span class="job-date"><i class="fa fa-calendar"> <?php echo $job->getJobDate(); ?></i></span>
                            <a href="?action=view_job&job_id=<?php echo $job->getID(); ?>" class="delete" title="View Details">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                           
                        </div>
                    </div>
                    
                <?php endforeach; ?>
        </div>
    </div>
</section>
<script type="text/javascript" src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
<script type="text/javascript">
$("#categories, #cities, #countries").on("change", function() {
    //var form = $("#filter-jobs");
    $("#submitfilter").click();
});
</script>
<?php include '../view/footer.php'; ?>