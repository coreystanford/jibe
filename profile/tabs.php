

			<ul class="tab-list">
				<li class="active"><a class="tab-control" href="#tab-1">Projects</a></li>
				<li><a class="tab-control" href="#tab-2">Activity</a></li>
				<li><a class="tab-control" href="#tab-3">Statistics</a></li>
			</ul>
			<div class="tab-panel active on" id="tab-1">
				<div class="personal">

				<?php foreach ($projects as $project) : ?>

					<div class="project own">
						<a href="#" title="<?php echo $project->getProjDesc(); ?>"><img src="../images/<?php echo $project->getProjThumb(); ?>" /></a>
						<div class="info">
							<a href="#" class="edit" ><i class="fa fa-pencil fa-lg"></i></a>
							<a href="#" class="delete"><i class="fa fa-trash-o fa-lg"></i></a>
							<span class="approvals"><i class="fa fa-check"></i> 1020</span>
						</div>
					</div>

				<?php endforeach; ?>

				</div>
			</div>
			<div class="tab-panel on" id="tab-2">
				<div class="activity">
					
				</div>
			</div>
			<div class="tab-panel on" id="tab-3">
				<div class="stats">
					
				</div>
			</div>

		</div><!-- END main -->

	</section><!-- END main section -->
	
	<?php include '../view/footer.php'; ?>

	<div id="modal"></div>