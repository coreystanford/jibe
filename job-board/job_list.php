<?php include '../view/header.php'; ?>

<section role=main>

    <div class="slim clearfix">
        <p><?php echo $message_success; ?><?php echo $message_fail; ?></p>

        <div class="job-filters clearfix job-left" >

            <form id="filter-jobs" name="filter-jobs" method="post">
                    <h4 class="job-inline">Filter results</h4>
                <div class="job-drop-down">
                    <select name="categories" >
                        <option value="allcategories">--Select Category--</option>
                        <?php
                        foreach ($categories as $category) {
                            ($job_cat == $category->getID()) ? $attr_selected = 'selected = "selected"' : $attr_selected = '';
                            ?>
                            <option value="<?php echo $category->getID(); ?>" <?php echo $attr_selected; ?> ><?php echo $category->getTitle(); ?></option>

                            <?php
                        }
                        ?>
                    </select>
                </div>             
               
                <div class="job-drop-down">
                    <select name="cities" >
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
                    <select name="countries" >
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
                    <button type="submit" name="submitfilter" value="Filter" class="fa fa-filter job-inline-button job-right"></button>

            </form>
         </div><!--end filters div -->

        <form method="post" class="job-inline job-right">
            <button type="submit" name="resetfilter" value ="Reset" class="fa fa-remove job-inline-button job-right"></button>
            </form>
        <div class="clearfix">
            <h1>Current listings</h1>
            <ul class="nav">
                <?php foreach ($jobs as $job) : ?>
                    <li>
                        <a href="?action=view_job&job_id=<?php echo $job->getID(); ?>">
                            <?php echo $job->getJobTitle(); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
<?php include '../view/footer.php'; ?>