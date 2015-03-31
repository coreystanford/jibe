<?php include '../view/header.php'; ?>

	<section role=main>
		
		<div class="feed"></div><!-- end feed -->
		
		<div class="load-more clearfix">

			<a href="#" id="load-more"><span>Load More <i class="fa fa-chevron-down fa-lg"></i></span></a>

		</div><!-- end load-more -->

		<!-- hold 'limit' and 'load' information from the database for AJAX -->
		<input type="hidden" name="limit" id="limit" value="<?php echo $limit; ?>"/>
		<input type="hidden" name="loads" id="loads" value="<?php echo $loads; ?>"/>

	</section><!-- end main section -->
	
<?php include '../view/footer.php'; ?>

<script type="text/javascript" src="../js/infinite.js"></script>

<div id="modal"></div><!-- end modal -->