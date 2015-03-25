<?php 

$id = $_POST['id'];
$img = $_POST['img'];

?>

<div id="img-content">
	
	<h2>Delete Image</h2>

	<button role="button" id="modal-close"><i class="fa fa-times"></i></button>

	<form action="." method="post">

		<input type="hidden" value="<?php echo $id ?>">

		<input type="submit" value="Delete">

	</form>

</div>