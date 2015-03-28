<?php include '../view/header.php'; ?>

	<section role=main>
		
		<div class="feed">

		</div>

		<div class="load-more clearfix">

			<a href="#" id="load-more"><span>Load More <i class="fa fa-chevron-down fa-lg"></i></span></a>

		</div>

		<input type="hidden" name="limit" id="limit" value="<?php echo $limit; ?>"/>
		<input type="hidden" name="loads" id="loads" value="<?php echo $loads; ?>"/>

	</section><!-- END main section -->
	
<?php include '../view/footer.php'; ?>

<div id="modal"></div>