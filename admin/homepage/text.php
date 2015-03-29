<?php include '../view/header.php'; ?>

		<section role=main>

			<div class="main-admin">
				
				<h1>Homepage</h1>

				<div id="featured-info">

					<a href="./?action=text-edit" class="edit"><i class="fa fa-pencil fa-lg"></i> Edit Details</a>

					<div id="main-heading">

						<h3>Main Heading:</h3>
						<h4><?php echo $main; ?></h4>

					</div><!-- end main-heading -->

					<div id="sub-heading">

						<h3>Subheading:</h3>
						<h4><?php echo $sub; ?></h4>

					</div><!-- end sub-heading -->

					<div id="btn-link-txt">

						<h3>Button Text:</h3>
						<h4><?php echo $btn_text; ?></h4>

					</div><!-- end btn-link-txt -->

					<div id="btn-link">

						<h3>Button Link</h3>
						<h4><?php echo $btn_link; ?></h4>

					</div><!-- end btn-link -->

				</div><!-- end featured-info -->