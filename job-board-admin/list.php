<?php include '../view/header.php'; ?>

<section role=main>

    <div class="slim clearfix">
				

        
        <p><?php echo "<span class=\"job-success\">" . $message_success . "</span>"; ?>
            <?php echo "<span class=\"job-failure\">" . $message_fail . "</span>"; ?></p>
            
        <div class="cat-container" >
            <h1>Current listings by <?php echo $current_user->getFName(); ?></h1>
    
     <!----------link to add new job--------------------
     has an option to add user id from GET request    
     used for demo purposes to demonstrate creating jobs by different users  --------->
            
            <?php if(isset($_GET['id'])): ?>
            
                <a href="?action=add_job&id=<?php echo $_GET['id']; ?>" class="edit">
                
            <?php else: ?>
 
                <a href="?action=add_job" class="edit">

            <?php endif; ?>
                    
                <i class="fa fa-plus fa-lg"></i>
                Add new job
            </a>
                <?php foreach ($jobs as $job) : ?>
                    <div class="category">
                        <span style="background: url('../<?php echo $job->getLogoUrl(); ?>') 50% 50%; width: 70px; display: block; background-size: cover;">
                            &nbsp;
                            <?php //echo $job->getJobCategory()->getIcon(); ?>
                        </span>
                        <div class="cat-title-options">
                            <h2><?php echo $job->getJobTitle(); ?></h2>
                            <a href="?action=edit_job&job_id=<?php echo $job->getID(); ?>" class="edit" title="Edit Job Listing">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>
                            <a href="#" class="delete job-delete" title="Delete Job Listing" >
                                <i class="fa fa-trash fa-lg"></i>
                            </a>
                        </div>
                    </div>
                    <div class="category confirm-delete" id="delete_<?php echo $job->getID(); ?>">
                        <div class="cat-title-options">
                            <h5>Job <?php echo $job->getJobTitle(); ?> will be permanently deleted</h5>

        <!------form to delete job-------------------->                    
                            
                            <form name="delete-form" method="post" action="?action=delete_job">
                                <input type="hidden" name="job_id" value="<?php echo $job->getID(); ?>" />
                                <button type="submit" name="deletejob" class="fa fa-check fa-lg" />
                                <button type="reset" name="resetjob" class="fa fa-remove fa-lg job-delete-cancel" />
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
    </div>
</section>
<?php include '../view/footer.php'; ?>