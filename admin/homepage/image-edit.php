	<div id="featured-img" class="clearfix">

		<form action="./#featured-img" method="post" enctype="multipart/form-data">

			<!-- form controller action -->
			<input type="hidden" name="action" value="image-update"/>

			<h2>Featured Image: </h2>

			<img src="../../images_upload/<?php echo $img; ?>" />

			<div class="cluster">

				<input type="file" name="main-img"/>
				<?php echo $imgfields->getField('main-img')->getHTML(); ?>

			</div><!-- end cluster -->

			<div class="cluster">
				<input type="submit" name="submit" value="Update" class="btn submit" />
        		<a href="../homepage#featured-img" class="btn submit">Cancel</a>
			</div><!-- end cluster -->

		</form><!-- end form -->
		
	</div><!-- end featured-img -->