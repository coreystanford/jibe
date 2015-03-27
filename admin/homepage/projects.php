				


				<div class="featured-proj" id="featured-proj">
				
					<a href="./?action=unfeatured" class="edit"><i class="fa fa-plus fa-lg"></i> Add a Featured Project </a>

					<h2>Featured Projects: </h2>
						
					<?php foreach ($projects as $project) : ?>

						<div class="feature">

							<a href="#featured-proj" title="<?php echo $project->getProjDesc(); ?>"><img src="../../images/<?php echo $project->getProjThumb(); ?>" /></a>
							<div class="info">
								<img src="../../images/<?php echo $project->getUser()->getImgURL(); ?>" class="user-profile" />

								<form action="./#featured-proj" method="post">
				                    <input type="hidden" name="action" value="remove-project" />
				                    <input type="hidden" name="id" value="<?php echo $project->getID(); ?>" />
				                    <input type="submit" class="delete" value="" title="Remove Featured Project"><i class="fa fa-times fa-lg"></i></input>
				                </form>

								<span class="approvals"><i class="fa fa-check"></i> 1020</span>
							</div>

						</div><!-- END featured -->

					<?php endforeach; ?>

				</div><!-- END featured-proj -->

			</div>

		</section><!-- END main section -->
		
		<?php include '../view/footer.php'; ?>