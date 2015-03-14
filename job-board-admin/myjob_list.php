<?php include '../view/header.php'; ?>

<section role=main>

    <div class="slim clearfix">

        
        
            <h1>Current listings by <?php echo $current_user->getFName(); ?></h1>
            <ul class="nav">
                <?php foreach ($jobs as $job) : ?>
                    <li>
                        <a href="?action=edit_job&job_id=<?php echo $job->getID(); ?>">
                            <?php echo $job->getJobTitle(); ?>
                            <i class="fa fa-edit"></i>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
    </div>
</section>
<?php include '../view/footer.php'; ?>