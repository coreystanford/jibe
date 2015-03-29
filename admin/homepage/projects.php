		<div class="featured-proj" id="featured-proj">
		
			<a href="./?action=unfeatured" class="edit"><i class="fa fa-plus fa-lg"></i> Add a Featured Project </a>

			<h2>Featured Projects: </h2>
				
			<!-- loop through projects -->
			<?php foreach ($projects as $project) : ?>

				<div class="feature">

					<a href="#featured-proj" title="<?php echo $project->getProjDesc(); ?>"><img src="../../images/<?php echo $project->getProjThumb(); ?>" /></a>

					<div class="info">

						<img src="../../images_upload/thumbs/<?php echo $project->getUser()->getImgURL(); ?>" class="user-profile" />

						<form action="./#featured-proj" method="post">

							<!-- form controller action -->
		                    <input type="hidden" name="action" value="remove-project" />
		                    <!-- project id -->
		                    <input type="hidden" name="id" value="<?php echo $project->getID(); ?>" />

		                    <input type="submit" class="delete" value="" title="Remove Featured Project"><i class="fa fa-times fa-lg"></i></input>

		                </form><!-- end form -->

						<span class="approvals"><i class="fa fa-check"></i> 1020</span>

					</div><!-- end info -->

				</div><!-- end feature -->

			<?php endforeach; ?>
			<!-- end loop -->

		</div><!-- end featured-proj -->

	</div><!-- end main-admin -->

</section><!-- end main section -->

<?php include '../view/footer.php'; ?>