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
			
				<!-- loop through each category -->
				<?php foreach ($categories as $category) : ?>
					
					<div class="category">

						<span><i class='fa <?php echo $category->getIcon(); ?>'></i></span>

						<div class="cat-title-options">

							<h2><?php echo $category->getTitle(); ?></h2>

							<span class="cat-count"><i class="fa fa-briefcase"></i><?php echo $category->getProjCount(); ?></span>

							<a href="./?action=edit&id=<?php echo $category->getID(); ?>" class="edit" title="Edit Category"><i class="fa fa-pencil fa-lg"></i></a>
							
							<a href="./?action=delete&id=<?php echo $category->getID(); ?>" class="delete" title="Delete Category"><i class="fa fa-trash-o fa-lg"></i></a>

						</div><!-- end cat-title-options -->

					</div><!-- end category -->

				<?php endforeach; ?>
				<!-- end loop -->

			</div><!-- end cat-container -->

		</div><!-- end main-admin -->

	</section><!-- end main section -->

<?php include '../view/footer.php'; ?>