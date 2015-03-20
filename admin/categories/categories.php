<?php include '../view/header.php'; 

if(!isset($categories)){
    header('Location: ../categories');
}

?>

	<section role=main>

		<div class="main-admin">
			<div class="cat-container">
				<h1>Categories</h1>
				<a href="./?action=insert" class="edit"><i class="fa fa-plus fa-lg"></i> Add a Category </a>
			

				<?php foreach ($categories as $category) : ?>
					
					<div class="category">

						<span><i class='fa <?php echo $category->getIcon(); ?>'></i></span>

						<div class="cat-title-options">

							<h2><?php echo $category->getTitle(); ?></h2>

							<span class="cat-count"><?php echo $category->getProjCount(); ?></span>
							<a href="./?action=edit&id=<?php echo $category->getID(); ?>" class="edit" ><i class="fa fa-pencil fa-lg" title="Edit Category"></i></a>
							<a href="./?action=delete&id=<?php echo $category->getID(); ?>" class="delete"><i class="fa fa-trash-o fa-lg" title="Delete Category"></i></a>

						</div><!-- END cat-title-options -->

					</div><!-- END category -->

				<?php endforeach; ?>

			</div><!-- END cat-container -->

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';