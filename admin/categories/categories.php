<?php include '../view/header.php'; 

if(!isset($categories)){
    header('Location: ../categories');
}

?>

	<section role=main>

		<div class="main-admin">
			<div class="cat-container">
				<h1>Categories</h1>
				<a href="#" class="edit"><i class="fa fa-plus fa-lg"></i> Add a Category </a>
			

				<?php foreach ($categories as $category) : ?>
					
					<div class="category">

						<span><?php echo $category->getIcon(); ?></span>

						<div class="cat-title-options">

							<h2><?php echo $category->getTitle(); ?></h2>
							<a href="#" class="edit" ><i class="fa fa-pencil fa-lg"></i></a>
							<a href="#" class="delete"><i class="fa fa-trash-o fa-lg"></i></a>

						</div><!-- END cat-title-options -->

					</div><!-- END category -->

				<?php endforeach; ?>

			</div><!-- END cat-container -->

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';