	<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">
			
			<h1>Homepage</h1>

			<div class="featured-proj">
			
				<a href="../homepage" class="edit"><i class="fa fa-arrow-left fa-lg"></i> Return </a>

				<h2>Add Featured Projects: </h2>

				<div class="feed">

				</div>
				
				<div class="load-more clearfix">

					<a href="#" id="load-more"><span>Load More <i class="fa fa-chevron-down fa-lg"></i></span></a>

				</div>

			</div>
		</div>

		<input type="hidden" name="limit" id="limit" value="<?php echo $limit; ?>"/>
		<input type="hidden" name="loads" id="loads" value="<?php echo $loads; ?>"/>

	</section><!-- END main section -->
	
	<?php include '../view/footer.php'; ?>