	<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">
			
			<h1>Homepage</h1>

			<div class="featured-proj">
			
				<a href="../homepage" class="edit"><i class="fa fa-arrow-left fa-lg"></i> Return </a>

				<h2>Add Featured Projects: </h2>

				<?php foreach ($projects as $project) : ?>

						<div class="feature">

							<a href="#" title="<?php echo $project->getProjDesc(); ?>"><img src="../../images/<?php echo $project->getProjThumb(); ?>" /></a>
							<div class="info">
								<img src="../../images/<?php echo $project->getUser()->getImgURL(); ?>" class="user-profile" />

								<form action="." method="post">
				                    <input type="hidden" name="action" value="remove-project" />
				                    <input type="hidden" name="id" value="<?php echo $project->getID(); ?>" />
				                    <input type="submit" class="delete" value="" title="Remove Featured Project"><i class="fa fa-times fa-lg"></i></input>
				                </form>

								<span class="approvals"><i class="fa fa-check"></i> 1020</span>
							</div>

						</div><!-- END featured -->

					<?php endforeach; ?>

			</div>
		</div>

	</section><!-- END main section -->
	
	<?php include '../view/footer.php'; ?>