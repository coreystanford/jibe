<?php include '../view/header.php'; ?>

		<section role=main>

			<div class="main-admin">
				
				<h1>Homepage</h1>

				<div id="featured-info">

					<form action="." method="post">

						<input type="hidden" name="action" value="text-update"/>

						<div id="main-heading">
							<h3>Main Heading:</h3>
							<input type="text" name="main" value="Share your Inspiration."/>
							<?php echo $textfields->getField('main')->getHTML(); ?>
						</div>
						
						<div id="sub-heading">
							<h3>Subheading:</h3>
							<input type="text" name="sub" value="Collect. Collaborate. Create."/>
							<?php echo $textfields->getField('sub')->getHTML(); ?>
						</div>

						<div id="btn-link-txt">
							<h3>Button Text:</h3>
							<input type="text" name="btn-text" value="http://www.jibe.com/register/"/>
							<?php echo $textfields->getField('btn-text')->getHTML(); ?>
						</div>

						<div id="btn-link">
							<h3>Button Link</h3>
							<input type="text" name="btn-link" value="http://www.jibe.com/register/"/>
							<?php echo $textfields->getField('btn-link')->getHTML(); ?>
						</div>

						<div class="cluster">
							<input type="submit" name="submit" value="Insert" class="btn submit" />
                    		<a href="../categories" class="btn submit">Cancel</a>
						</div>

					</form>

				</div>