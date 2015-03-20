<?php include '../view/header.php'; ?>

		<section role=main>
			
			<div class="feed">
				
				<?php foreach ($projects as $project): ?>
					
					<div class="project">
						<a href="#<?php echo $project->getID(); ?>" title="<?php echo $project->getProjDesc(); ?>"><img src="<?php echo $project->getProjThumb(); ?>" /></a>
						<div class="info">
							<img src="<?php echo $project->getUser()->getImgURL(); ?>" class="user-profile" />
							<span class="category" title="<?php echo $project->getCat()->getTitle(); ?>"><i class='fa <?php echo $project->getCat()->getIcon(); ?>'></i></span>
							<span class="approvals"><i class="fa fa-check"></i> 15</span>
						</div>
					</div>

				<?php endforeach ?>

			</div>

		</section><!-- END main section -->
		
		<?php include '../view/footer.php'; ?>