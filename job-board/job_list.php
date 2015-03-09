<?php include '../view/header.php'; ?>

<section role=main>
			
    <div class="main">
        
    <h1>Jobs</h1>
<!--        <ul class="nav">
             display links for all categories 
            <?php // foreach($categories as $category) : ?>
            <li>
                <a href="?cat_id=<?php // echo $category->getID(); ?>">
                    <?php // echo $category->getTitle(); ?>
                </a>
            </li>
            <?php // endforeach; ?>
        </ul>-->

<!--        <h1><?php // echo $current_author->getName(); ?></h1>-->
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
</section>
        <?php include '../view/footer.php'; ?>