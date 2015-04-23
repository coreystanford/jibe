<?php 

	$id = $_POST['id'];
	$img = $_POST['img'];

?>

	<div id="img-content">
		
		<h2>Delete Your Profile Image?</h2>

		<form action="." method="post">

			<!-- form controller action -->
			<input type="hidden" name="action" value="img-delete">
			<!-- user id -->
			<input type="hidden" name="user_id" value="<?php echo $id ?>">
			<!-- img name -->
			<input type="hidden" name="img" value="<?php echo $img ?>">

			<div class="cluster">
				<input type="submit" value="Delete" class="btn submit">
				<a href="../profile/" class="btn submit">Cancel</a>
			</div><!-- end cluster -->

		</form><!-- end form -->

	</div><!-- end img-content -->