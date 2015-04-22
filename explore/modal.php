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

$proj_id = $_POST['id'];
$project = ProjectDB::getProjectByID($proj_id);
$images = ProjectDB::getMediaByProjId($proj_id);

// ------------increases number of views-----------------------

ViewDB::addView($proj_id);

//-------------------------------------------------------------
$id = $project->getUser()->getID();

$followStatus = FollowDB::checkFollow($id, $SESSION_ID);

?>

<div id="feed-content">

	<div id="head" class="clearfix">
		
		<div id="proj-thumb">

			<img src="../images_upload/projects/<?php echo $project->getProjThumb(); ?>" />

		</div><!-- end proj-thumb -->

		<div id="proj-details">

			<h2><?php echo $project->getProjTitle(); ?></h2>
			<p><?php echo $project->getProjDesc(); ?></p>

		</div><!-- end proj-details -->

		<button role="button" id="modal-close"><i class="fa fa-times"></i></button>

	</div><!-- end head -->

	<div id="sub" class="clearfix">

		<!-- if the session id is 'following' the project creator's id, then display this: -->
		<?php if ($followStatus): ?>
			
			<a href="" rel="<?php echo $project->getUser()->getID(); ?>" class="unfollow-modal" ><span>Following</span></a>

		<!-- else, display this: -->
		<?php else: ?>

			<a href="" rel="<?php echo $project->getUser()->getID(); ?>" class="follow-modal" ><span>Follow</span></a>

		<?php endif ?>
		<!-- end if -->
                
                <!-- "Like" button   -->
                
                        <?php include '../likes/form.php'; ?>

                
                <!-- end "Like"  -->

		<!-- report user button (form) -->
		<form method="post" action="." class="report-form">

			<!-- form controller action -->
			<input type="hidden" name="action" value="report" />
			<!-- user id -->
            <input type="hidden" name="reported_id" value="<?php echo $project->getUser()->getID(); ?>" />
            <!-- project id -->
            <input type="hidden" name="proj_id" value="<?php echo $project->getID(); ?>" />

            <input type="submit" value="Report" class="report" />

		</form><!-- end report-form -->

	</div><!-- end sub -->

    <div id="content" class="clearfix">

        <?php foreach($images as $image): ?>

            <img src="../images_upload/projects/<?php echo $image->getURL(); ?>" alt="<?php echo $image->getAttribute(); ?>" />

        <?php endforeach; ?>

    </div><!-- end content -->

    <div id="comments" class="clearfix">

        <?php include '../comments/index.php'; ?>

    </div><!-- end comments -->

</div><!-- end feed-content -->