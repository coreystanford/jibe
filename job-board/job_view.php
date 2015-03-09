<?php include '../view/header.php'; ?>
<div id="main">
<!--    <div id="sidebar">
        <h1>Authors</h1>
        <ul class="nav">
             display links for all categories 
            <?php // foreach($authors as $author) : ?>
            <li>
                <a href="?author_id=<?php // echo $author->getID(); ?>">
                    <?php // echo $author->getName(); ?>
                </a>
            </li>
            <?php // endforeach; ?>
        </ul>
    </div>-->
    <div id="content">
        
        <div id="left_column">
            <p>
                <img src="<?php echo $job_listing->getJobLogoUrl(); ?>"
                    alt="<?php echo $job_listing->getJobCompany(); ?>" />
            </p>
        </div>

        <div id="right_column">
            <h1><?php echo $job_listing->getJobTitle();?></h1>
             <p>Listed by<?php  echo " by " . $job_listing->getUser()->getName(); ?></p>
            <p><b>Date created:</b> <?php echo $job_listing->getJobDate(); ?></p>
            <p><b>Description:</b> <?php echo $job_listing->getJobDescription(); ?></p>
<!--            
            <form action="<?php // echo '../cart' ?>" method="post">
                <input type="hidden" name="action" value="add" />
                <input type="hidden" name="project_id"
                       value="<?php //echo $project->getID(); ?>" />
                <b>Quantity:</b>
                <input type="text" name="quantity" value="1" size="2" />
                <input type="submit" value="Add to Cart" />
            </form>-->
        </div>
    </div>
</div>
<?php include '../view/footer.php'; ?>