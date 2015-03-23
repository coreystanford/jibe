<?php include '../view/header.php'; 



?>

	<section role=main>

		<div class="main-admin">

				<h1>Remove this Report?</h1>
			
				<form action="." method="post" id="delete_form">
					<div class="cluster">
	                    <input type="hidden" name="action" value="confirmed-delete" />
	                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	                    <input type="submit" class="btn deletebtn" value="Delete" />
	                    <h5><a href="../reported?action=resolved" class="btn submit">Cancel</a></h5>
	                </div>
                </form>                

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';