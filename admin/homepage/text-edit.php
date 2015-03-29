<?php include '../view/header.php'; ?>

		<section role=main>

			<div class="main-admin">
				
				<h1>Homepage</h1>

				<div id="featured-info" class="clearfix">

					<form action="." method="post">

						<!-- form controller action -->
						<input type="hidden" name="action" value="text-update"/>

						<div id="main-heading">

							<h3>Main Heading:</h3>
							<input type="text" name="main" value="<?php echo $main; ?>"/>
							<!-- validation message -->
							<?php echo $textfields->getField('main')->getHTML(); ?>

						</div><!-- end main-heading -->

						<div id="sub-heading">

							<h3>Subheading:</h3>
							<input type="text" name="sub" value="<?php echo $sub; ?>"/>
							<!-- validation message -->
							<?php echo $textfields->getField('sub')->getHTML(); ?>

						</div><!-- end sub-heading -->

						<div id="btn-link-txt">

							<h3>Button Text:</h3>
							<input type="text" name="btn-text" value="<?php echo $btn_text; ?>"/>
							<!-- validation message -->
							<?php echo $textfields->getField('btn-text')->getHTML(); ?>

						</div><!-- end btn-link-txt -->

						<div id="btn-link">

							<h3>Button Link</h3>
							<input type="text" name="btn-link" value="<?php echo $btn_link; ?>"/>
							<!-- validation message -->
							<?php echo $textfields->getField('btn-link')->getHTML(); ?>
							
						</div><!-- end btn-link -->

						<div class="cluster">
							<input type="submit" name="submit" value="Update" class="btn submit" />
                    		<a href="../homepage" class="btn submit">Cancel</a>
						</div><!-- end cluster -->

					</form><!-- end form -->

				</div><!-- end featured-info -->