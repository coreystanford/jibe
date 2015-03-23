<?php include '../view/header.php'; 



?>

	<section role=main>

		<div class="main-admin">
			<div class="main-admin">
				<h1>Delete <?php echo $category->getTitle(); ?></h1>
			
				<form action="." method="post" id="delete_form">
                    <input type="hidden" name="action" value="confirmed-delete" />
                    <input type="hidden" name="id" value="<?php echo $category->getID(); ?>" />
                    <input type="submit" value="Delete" />
                </form>
                <br />
                <h5><a href="../categories">Cancel</a></h5>

			</div><!-- END cat-container -->

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';