		<?php include 'view/anonymous-header.php'; ?>

		<section role=main>
			<div class="main-img">	
				<div class="featured">

					<div class="jibe-msg">
						<h1><?php echo $main; ?></h1>
						<h2><?php echo $sub; ?></h2>
						<a href="<?php echo $btn_link; ?>" class="btn link"><?php echo $btn_text; ?>   <i class="fa fa-arrow-right fa-lg"></i></a>
					</div>
				</div>
			</div>

			<a href="#home-feed" id="seeFeed"><i class="fa fa-chevron-down"></i></a>

			<div class="home-feed" id="home-feed">

				<?php foreach ($projects as $project) : ?>

						<div class="home-project">

							<a href="#modal" rel="<?php echo $project->getID(); ?>" title="<?php echo $project->getProjDesc(); ?>"><img src="./images/<?php echo $project->getProjThumb(); ?>" /></a>

						</div><!-- END featured -->

					<?php endforeach; ?>

			</div>

			<img class="off" id="invisible" src="./images/<?php echo $img ?>" />

		</section><!-- END main section -->
		
		<?php include 'view/anonymous-footer.php'; ?>

		<div id="modal"></div>
                