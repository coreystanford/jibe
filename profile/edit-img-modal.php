<?php 

$id = $_POST['id'];
$img = $_POST['img'];

?>

<div id="img-content">
	
	<h2>Update Your Profile Image</h2>

	<form action="." method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="img-update">
		<input type="hidden" name="id" value="<?php echo $id ?>">


		<div class="cluster">
			<input type="file" name="pro_thumb" />
		</div>
		
		<div class="cluster">
			<input type="submit" value="Update" class="btn submit">
			<a href="../profile/?id=<?php echo $id; ?>" class="btn submit">Cancel</a>
		</div>

	</form>

</div>