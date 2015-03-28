<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">
			<div class="cat-container">
				<h1>Profiles</h1>
			
				<?php foreach ($profiles as $profile) : ?>
					
					<div class="category">

						<img src="../../images_upload/profiles/<?php echo $profile->getImgURL(); ?>"/></span>

						<div class="cat-title-options">

							<h2><?php echo $profile->getFName(); ?> <?php echo $profile->getLName(); ?></h2>

							<a href="../../profile?id=<?php echo $profile->getID(); ?>" class="edit" title="Profile" target="_blank"><i class="fa fa-user fa-lg"></i></a>
							<a href="./?action=delete-user&id=<?php echo $profile->getID(); ?>" class="delete" title="Delete Profile"><i class="fa fa-trash-o fa-lg"></i></a>

						</div><!-- END cat-title-options -->

					</div><!-- END category -->

				<?php endforeach; ?>

			</div><!-- END cat-container -->

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';