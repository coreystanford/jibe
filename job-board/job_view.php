<?php include '../view/header.php'; ?>
<section role=main>

    <div class="slim clearfix">
                <?php include_once 'menu.php'; ?>

        <div class="left-column clearfix">
            <p>
                <img src="<?php echo "../" . $job_listing->getLogoUrl(); ?>"
                     alt="<?php echo $job_listing->getJobCompany(); ?>" class="job-logo-url" />
            </p>
        </div>

        <div class="right-column clearfix">
            <h1><?php echo $job_listing->getJobTitle(); ?></h1>
            <p>Listed by<?php echo " by " . $job_listing->getUser()->getFName() . " " . $job_listing->getUser()->getLName(); ?></p>
            <p><b>Date created:</b> <?php echo $job_listing->getJobDate(); ?></p>
            <p><b>Description:</b> <?php echo $job_listing->getJobDescription(); ?></p>
            <!--            
                        <form action="<?php // echo '../cart'  ?>" method="post">
                            <input type="hidden" name="action" value="add" />
                            <input type="hidden" name="project_id"
                                   value="<?php //echo $project->getID();  ?>" />
                            <b>Quantity:</b>
                            <input type="text" name="quantity" value="1" size="2" />
                            <input type="submit" value="Add to Cart" />
                        </form>-->
        </div>
    </div>
</section>
<?php include '../view/footer.php'; ?>