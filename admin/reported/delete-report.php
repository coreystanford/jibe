<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">

				<h1>Remove this report?</h1>
				
				<div class="cluster-center">
                    <h3>Report ID: <?php echo $id; ?></h3>
                </div>

                <div class="cluster-left">
                    <h3>Reported User:</h3>
                    <div class="cluster">
                        <a href="../../profile?id=<?php echo $reported->getID(); ?>" target="_blank"><h2><?php echo $reported->getFName(); ?> <?php echo $reported->getLName(); ?></h2></a>
                    </div>
                </div>
                <div class="cluster-right">
                    <h3>Reported By:</h3>
                    <div class="cluster">
                        <a href="../../profile?id=<?php echo $reporter->getID(); ?>" target="_blank"><h2><?php echo $reporter->getFName(); ?> <?php echo $reporter->getLName(); ?></h2></a>
                    </div>
                </div>

                <div id="feed-content">

                    <div id="head" class="clearfix">
                        
                        <div id="proj-thumb">
                            <img src="../../images/<?php echo $project->getProjThumb(); ?>" />
                        </div>

                        <div id="proj-details">
                            <h2><?php echo $project->getProjTitle(); ?></h2>
                            <p><?php echo $project->getProjDesc(); ?></p>
                        </div>

                    </div>

                    <div id="content" class="clearfix">

                        
                        

                    </div>

                    <div id="comments" class="clearfix">

                        
                        

                    </div>

                </div><!-- END feed-content -->

				
				<div class="cluster">
					<h3>This cannot be undone.</h3>
				</div>

				<form action="." method="post">
					<div class="cluster">
	                    <input type="hidden" name="action" value="confirm-delete-report" />
	                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	                    <input type="submit" class="btn deletebtn" value="Delete" />
	                    <h5><a href="../reported?action=resolved" class="btn submit">Cancel</a></h5>
	                </div>
                </form>                

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';