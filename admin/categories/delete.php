<?php include '../view/header.php'; 

if(!isset($category)){
    header('Location: ../categories');
}

?>

	<section role=main>

		<div class="main-admin">
			<div class="main-admin">
				<h1>Delete <?php echo $category->getTitle(); ?>?</h1>
			
				<h3>This cannot be undone.</h3>

				<form action="." method="post" id="delete_form">

					<div class="cluster">
	                    <input type="hidden" name="action" value="confirmed-delete" />
	                    <input type="hidden" name="id" value="<?php echo $category->getID(); ?>" />
	                    <input type="submit" value="Delete" class="btn deletebtn" />
	                    <h5><a href="../categories" class="btn submit">Cancel</a></h5>
	                </div>
	                
                </form>

			</div><!-- END cat-container -->

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';