<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">

				<h1>Remove this report?</h1>
				
				<div class="cluster">
					<h3>Report Summary:</h3>
				</div>
				<div class="cluster">
					<h4>Report ID:</h4>
					<p><?php echo $id; ?></p>
				</div>
				<div class="cluster">
					<h4>Reported User:</h4>
					<p><?php echo $reported->getFName(); ?> <?php echo $reported->getLName(); ?></p>
				</div>
				<div class="cluster">
					<h4>Reported Project:</h4>
					<p><?php echo $project->getProjTitle(); ?></p>
					<p><?php echo $project->getProjDesc(); ?></p>
				</div>
				<div class="cluster">
					<h4>Reported By:</h4>
					<p><?php echo $reporter->getFName(); ?> <?php echo $reporter->getLName(); ?></p>
				</div>
				
				<div class="cluster">
					<h3>This cannot be undone.</h3>
				</div>

				<form action="." method="post" id="delete_form">
					<div class="cluster">
	                    <input type="hidden" name="action" value="confirmed-delete" />
	                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	                    <input type="submit" class="btn deletebtn" value="Delete" />
	                    <h5><a href="../reported?action=resolved" class="btn submit">Cancel</a></h5>
	                </div>
                </form>                

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';