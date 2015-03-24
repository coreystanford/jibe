<?php include '../view/header.php'; ?>

		<section role=main>
			
			<div class="feed">
				
				<?php foreach ($projects as $project): ?>
					
					<div class="project">
						<a href="#modal" class="open-modal" rel="<?php echo $project->getID(); ?>" title="<?php echo $project->getProjDesc(); ?>"><img src="../images/<?php echo $project->getProjThumb(); ?>" /></a>
						<div class="info">
							<a href="../profile?id=<?php echo $project->getUser()->getID(); ?>" class="user-profile" title="<?php echo $project->getUser()->getFName(); ?> <?php echo $project->getUser()->getLName(); ?>"><img src="../images/<?php echo $project->getUser()->getImgURL(); ?>"  /></a>
							<span class="category" title="<?php echo $project->getCat()->getTitle(); ?>"><i class='fa <?php echo $project->getCat()->getIcon(); ?>'></i></span>
							<span class="approvals"><i class="fa fa-check"></i> 15</span>
						</div>
					</div>

				<?php endforeach ?>

			</div>

		</section><!-- END main section -->
		
		<?php include '../view/footer.php'; ?>

		<div id="modal"></div>