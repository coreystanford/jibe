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
	
    $projects = ProjectDB::getFeedProjects($SESSION_ID, $offset, $limit);

?>

<?php foreach ($projects as $project): ?>
<!-- loop through projects -->
					
	<div class="project">

		<a href="#modal" class="open-modal"rel="<?php echo $project->getID(); ?>" title="<?php echo $project->getProjDesc(); ?>"><img src="../images/<?php echo $project->getProjThumb(); ?>" /></a>

		<div class="info">

			<a href="../profile?id=<?php echo $project->getUser()->getID(); ?>" class="user-profile" title="<?php echo $project->getUser()->getFName(); ?> <?php echo $project->getUser()->getLName(); ?>"><img src="../images_upload/thumbs/<?php echo $project->getUser()->getImgURL(); ?>"  /></a>
			<span class="category" title="<?php echo $project->getCat()->getTitle(); ?>"><i class='fa <?php echo $project->getCat()->getIcon(); ?>'></i></span>
			<span class="approvals"><i class="fa fa-check"></i> 15</span>

		</div><!-- end info -->

	</div><!-- end project -->

<!-- end loop -->
<?php endforeach ?>