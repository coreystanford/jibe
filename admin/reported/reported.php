<?php include '../view/header.php'; 

if(!isset($categories)){
    header('Location: ../categories');
}

?>

	<section role=main>

		<div class="main-admin">
			<div class="report-container">
				<h1>Reported</h1>

				<?php foreach ($categories as $category) : ?>
					
					<div class="category">

						<span><i class='fa <?php echo $category->getIcon(); ?>'></i></span>

						<div class="cat-title-options">

							<h2><?php echo $category->getTitle(); ?></h2>
							<a href="./?action=edit&id=<?php echo $category->getID(); ?>" class="edit" ><i class="fa fa-pencil fa-lg"></i></a>
							<a href="./?action=delete&id=<?php echo $category->getID(); ?>" class="delete"><i class="fa fa-trash-o fa-lg"></i></a>

						</div><!-- END cat-title-options -->

					</div><!-- END category -->

				<?php endforeach; ?>

			</div><!-- END cat-container -->

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';