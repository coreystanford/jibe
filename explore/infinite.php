<?php

    require_once '../model/database.php';
    include '../model/category.php';
	include '../model/user.php';
	include '../model/project.php';
    require_once '../model/projectDB.php';

    if(isset($_SESSION['id'])){
	    $SESSION_ID = $_SESSION['id'];
	} else {
	    $SESSION_ID = 1;
	}

	$limit = $_POST['limit'];
	$offset = $_POST['offset'];


    $projects = ProjectDB::getExploreProjects($SESSION_ID, $offset, $limit);

?>

		<?php foreach ($projects as $project): ?>
					
			<div class="project">
				<a href="#modal" class="open-modal" rel="<?php echo $project->getID(); ?>" title="<?php echo $project->getProjDesc(); ?>"><img src="../images/<?php echo $project->getProjThumb(); ?>" /></a>
				<div class="info">
					<a href="../profile?id=<?php echo $project->getUser()->getID(); ?>" class="user-profile" title="<?php echo $project->getUser()->getFName(); ?> <?php echo $project->getUser()->getLName(); ?>"><img src="../images/<?php echo $project->getUser()->getImgURL(); ?>" /></a>
					<span class="category" title="<?php echo $project->getCat()->getTitle(); ?>"><i class='fa <?php echo $project->getCat()->getIcon(); ?>'></i></span>
					<span class="approvals"><i class="fa fa-check"></i> 15</span>
				</div>
			</div>

		<?php endforeach ?>