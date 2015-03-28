<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">

				<h1>Delete this project?</h1>

				<div class="cluster">
					<h2> Project Owner: <a href="../../profile?id=<?php echo $project->getUser()->getID(); ?>" title="Project Owner" target="_blank"><?php echo $project->getUser()->getFName(); ?> <?php echo $project->getUser()->getLName(); ?></a></h2>
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
	                    <input type="hidden" name="action" value="confirm-delete-project" />
	                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	                    <input type="submit" class="btn deletebtn" value="Delete" />
	                    <h5><a href="../reported" class="btn submit">Cancel</a></h5>
	                </div>
                </form>                

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';