<?php

    require '../../model/autoload.php';

	if(!isset($_POST['limit'])){
		header('Location: .');
	}

	$limit = $_POST['limit'];
	$offset = $_POST['offset'];
	
    $projects = HomepageDB::getUnfeatured($offset, $limit);

?>

	<!-- loop through projects -->
	<?php foreach ($projects as $project) : ?>

		<div class="feature">

			<a href="#" title="<?php echo $project->getProjDesc(); ?>"><img src="../../images_upload/projectthumbs/<?php echo $project->getProjThumb(); ?>" /></a>

			<div class="info">

				<img src="../../images_upload/thumbs/<?php echo $project->getUser()->getImgURL(); ?>" class="user-profile" />

				<form action="." method="post">

					<!-- form controller action -->
                    <input type="hidden" name="action" value="add-project" />
                    <!-- project id -->
                    <input type="hidden" name="id" value="<?php echo $project->getID(); ?>" />

                    <input type="submit" class="delete" value="" title="Add Featured Project"><i class="fa fa-plus fa-lg"></i></input>

                </form><!-- end form -->

				<span class="approvals"><i class="fa fa-check"></i> 1020</span>

			</div><!-- end info -->

		</div><!-- end feature -->

	<?php endforeach; ?>
	<!-- end loop -->