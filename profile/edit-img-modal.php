<?php 

	$id = $_POST['id'];
	$img = $_POST['img'];

?>

	<div id="img-content">
		
		<h2>Update Your Profile Image</h2>

		<form action="." method="post" enctype="multipart/form-data">

			<!-- form controller action -->
			<input type="hidden" name="action" value="img-update">
			<!-- user id -->
			<input type="hidden" name="id" value="<?php echo $id ?>">

			<div class="cluster">

				<input type="file" name="pro_thumb" />

			</div><!-- end cluster -->
			
			<div class="cluster">
				<input type="submit" value="Update" class="btn submit">
				<a href="../profile/" class="btn submit">Cancel</a>
			</div><!-- end cluster -->

		</form><!-- end form -->

	</div><!-- end img-content -->