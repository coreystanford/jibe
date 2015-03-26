<?php 

$id = $_POST['id'];
$img = $_POST['img'];

?>

<div id="img-content">
	
	<h2>Delete Your Profile Image?</h2>

	<button role="button" id="modal-close"><i class="fa fa-times"></i></button>

	<form action="." method="post">

		<input type="hidden" value="<?php echo $id ?>">

		<div class="cluster">
			<input type="submit" value="Delete" class="btn submit">
			<a href="../profile/?id=<?php echo $id; ?>" class="btn submit">Cancel</a>
		</div>	

	</form>

</div>