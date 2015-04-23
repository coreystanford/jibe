<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">

				<h1>Remove this report?</h1>
				
				<div class="cluster-center">

                    <h3>Report ID: <?php echo $id; ?></h3>

                </div><!-- end cluster-center -->

                <div class="cluster-left">

                    <h3>Reported User:</h3>

                    <div class="cluster">

                        <a href="../../profile?id=<?php echo $reported->getID(); ?>" target="_blank"><h2><?php echo $reported->getFName(); ?> <?php echo $reported->getLName(); ?></h2></a>
                    
                    </div><!-- end cluster -->

                </div><!-- end cluster-left -->

                <div class="cluster-right">

                    <h3>Reported By:</h3>

                    <div class="cluster">

                        <a href="../../profile?id=<?php echo $reporter->getID(); ?>" target="_blank"><h2><?php echo $reporter->getFName(); ?> <?php echo $reporter->getLName(); ?></h2></a>

                    </div><!-- end cluster -->

                </div><!-- end cluster-right -->

                <div id="feed-content">

                    <div id="head" class="clearfix">
                        
                        <div id="proj-thumb">

                            <img src="../../images_upload/projectthumbs/<?php echo $project->getProjThumb(); ?>" />

                        </div><!-- end proj-thumb -->

                        <div id="proj-details">

                            <h2><?php echo $project->getProjTitle(); ?></h2>
                            <p><?php echo $project->getProjDesc(); ?></p>

                        </div><!-- end proj-details -->

                    </div><!-- end head -->

                    <div id="content" class="clearfix">

                        <?php foreach($images as $image): ?>

                            <img src="../../images_upload/projects/<?php echo $image->getURL(); ?>" alt="<?php echo $image->getAttribute(); ?>" />

                        <?php endforeach; ?>

                    </div><!-- end content -->

                    <div id="comments" class="clearfix">

                        

                    </div><!-- end comments -->

                </div><!-- end feed-content -->

				<div class="cluster">

					<h3>This cannot be undone.</h3>

				</div><!-- end cluster -->

				<form action="." method="post">

                    <!-- form controller action -->
                    <input type="hidden" name="action" value="confirm-delete-report" />
                    <!-- report id -->
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />

					<div class="cluster">
	                    <input type="submit" class="btn deletebtn" value="Delete" />
	                    <h5><a href="../reported?action=resolved" class="btn submit">Cancel</a></h5>
	                </div>

                </form><!-- end form -->

		</div><!-- end main-admin -->

	</section><!-- end main section -->

<?php include '../view/footer.php'; ?>