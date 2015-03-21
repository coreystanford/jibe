<?php include '../view/header.php'; ?>

	<section role=main>
		
		<div class="main">
			
		<!-- Slider Section -->

			<div class="slider">
				<div class="slide-group">
					<div class="slide">
						<img src="../images/slide2.jpg">
					</div>
					<div class="slide">
						<img src="../images/slide1.jpg">
					</div>
					<div class="slide">
						<img src="../images/slide3.jpg">
					</div>
					<div class="slide">
						<img src="../images/slide4.jpg">
					</div>
				</div>
			</div>
			<div class="slide-buttons"></div>

		<!-- User Information Section -->

			<div id="user" class="user clearfix">

				<div class="photo" >
					<img src="../images/<?php echo $pro_img; ?>"  />
				</div>
				<div class="name">
					<h1><?php echo $fname; ?> <?php echo $lname; ?></h1>
					<h3><?php echo $specialty; ?></h3>
					<h4><?php echo $website; ?></h4>
					<h4><?php echo $city; ?>, <?php echo $country; ?></h4>
				</div>
				<div class="bio">
					<p><?php echo $bio; ?></p>
				</div>

			</div>

		<!-- Tab Section -->

			<ul class="tab-list">
				<li class="active"><a class="tab-control" href="#tab-1">Projects</a></li>
				<li><a class="tab-control" href="#tab-2">Activity</a></li>
				<li><a class="tab-control" href="#tab-3">Statistics</a></li>
			</ul>
			<div class="tab-panel active on" id="tab-1">
				<div class="personal">

				<?php foreach ($projects as $project) : ?>

					<div class="project">
						<a href="#<?php echo $project->getID(); ?>" title="<?php echo $project->getProjDesc(); ?>"><img src="../images/<?php echo $project->getProjThumb(); ?>" /></a>
						<div class="info">
							<img src="../images/<?php echo $project->getProjThumb(); ?>" class="user-profile" />
							<span class="category" title="<?php echo $project->getCat()->getTitle(); ?>"><i class='fa <?php echo $project->getCat()->getIcon(); ?>'></i></span>
							<span class="approvals"><i class="fa fa-check"></i> 15</span>
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