<?php

    require '../model/autoload.php';

    if (!isset($_SESSION)){
        session_start();
    }

    if(!HomepageDB::isLoggedIn()){
        header("Location: ../");
        die();
    }

    if(isset($_SESSION['user_id'])){
        $SESSION_ID = $_SESSION['user_id'];
    }

	$limit = $_POST['limit'];
	$offset = $_POST['offset'];


    $projects = ProjectDB::getExploreProjects($SESSION_ID, $offset, $limit);

?>

	<!-- loop through projects -->
	<?php foreach ($projects as $project): ?>
				
		<div class="project">

			<a href="#modal" class="open-modal" rel="<?php echo $project->getID(); ?>" title="<?php echo $project->getProjDesc(); ?>"><img src="../images_upload/projectthumbs/<?php echo $project->getProjThumb(); ?>" /></a>

			<div class="info">

				<a href="../profile?id=<?php echo $project->getUser()->getID(); ?>" class="user-profile" title="<?php echo $project->getUser()->getFName(); ?> <?php echo $project->getUser()->getLName(); ?>"><img src="../images_upload/thumbs/<?php echo $project->getUser()->getImgURL(); ?>" /></a>

				<span class="category" title="<?php echo $project->getCat()->getTitle(); ?>"><i class='fa <?php echo $project->getCat()->getIcon(); ?>'></i></span>

				<span class="approvals"><i class="fa fa-check"></i>
                                   <?php echo (count(LikeDB::getLikesByProjId($project->getID()))); ?>
                                    </span>

			</div><!-- end info -->

		</div><!-- end project -->

	<?php endforeach ?>
	<!-- end loop -->