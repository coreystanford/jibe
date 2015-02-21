	<?php 

	require 'model/formValidator.php';
	require 'model/displayList.php';
	include_once 'view/header.php'; 

	$templates = ["Standard", "Slider", "Extended"];

	$categories = ["Select", "Fine Art","Graphic Design","Illustration","Motion Graphics","Photography","Typography", "Videography", "Web Design", "Web Development"];

	$icons = ["<i class='fa fa-paint-brush'></i>","<i class='fa fa-connectdevelop'></i>","<i class='fa fa-pencil-square-o'></i>","<i class='fa fa-play'></i>","<i class='fa fa-camera'></i>","<i class='fa fa-font'></i>","<i class='fa fa-video-camera'></i>","<i class='fa fa-desktop'></i>","<i class='fa fa-sitemap'></i>"];

	?>

	<section role=main>
		
		<div class="slim">
			
			<form method="post" action="" class="add-project">
				
				<label for="cat-dropdown" class="bold-labels">Select a Category: </label>
				<?php displayList("cat-dropdown", $categories, "dropdown"); ?>

				<label for="template-radios" class="bold-labels">Choose a Template: </label>
				<?php displayList("template-radios", $templates, "radio"); ?>

				

			</form>

		</div>

	</section><!-- END main section -->
	
	<?php include_once 'view/footer.php'; ?>