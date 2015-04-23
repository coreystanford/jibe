<?php include '../view/header.php'; ?>
<section role=main>

    <div class="slim clearfix">
                <?php include_once 'menu.php'; ?>

        <div class="left-column clearfix">
            <p>
                <img src="<?php echo "../" . $job_listing->getLogoUrl(); ?>"
                     alt="<?php echo $job_listing->getJobCompany(); ?>" />
            <h4><?php echo $job_listing->getJobCompany(); ?></h4>
            <h6><?php echo $job_listing->getJobCity(); ?></h6>
            <h6><?php echo $job_listing->getJobCountry(); ?></h6>
            
            </p>
        </div>

        <div class="right-column clearfix">
            <h1><?php echo $job_listing->getJobTitle(); ?></h1>
            <p>Listed by: <?php echo $job_listing->getUser()->getFName() . " " . $job_listing->getUser()->getLName(); ?>
                <em>Posted on: <?php echo $job_listing->getJobDate(); ?></em></p>
            <p><b>Description:</b> <?php echo $job_listing->getJobDescription(); ?></p>
            
        </div>
    </div>
</section>
<?php include '../view/footer.php'; ?>