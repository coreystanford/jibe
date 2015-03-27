<?php include '../view/header.php'; ?>

		<section role=main>

			<div class="main-admin">
				
				<h1>Homepage</h1>

				<div id="featured-info" class="clearfix">

					<form action="." method="post">

						<input type="hidden" name="action" value="text-update"/>

						<div id="main-heading">
							<h3>Main Heading:</h3>
							<input type="text" name="main" value="<?php echo $main; ?>"/>
							<?php echo $textfields->getField('main')->getHTML(); ?>
						</div>

						<div id="sub-heading">
							<h3>Subheading:</h3>
							<input type="text" name="sub" value="<?php echo $sub; ?>"/>
							<?php echo $textfields->getField('sub')->getHTML(); ?>
						</div>

						<div id="btn-link-txt">
							<h3>Button Text:</h3>
							<input type="text" name="btn-text" value="<?php echo $btn_text; ?>"/>
							<?php echo $textfields->getField('btn-text')->getHTML(); ?>
						</div>

						<div id="btn-link">
							<h3>Button Link</h3>
							<input type="text" name="btn-link" value="<?php echo $btn_link; ?>"/>
							<?php echo $textfields->getField('btn-link')->getHTML(); ?>
						</div>

						<div class="cluster">
							<input type="submit" name="submit" value="Update" class="btn submit" />
                    		<a href="../homepage" class="btn submit">Cancel</a>
						</div>

					</form>

				</div>