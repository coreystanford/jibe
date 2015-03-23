<?php 

require '../model/database.php';
require '../model/user.php';
require '../model/category.php';
require '../model/project.php';
require '../model/content.php';
require '../model/projectDB.php';

$proj_id = $_POST['id'];

$project = ProjectDB::getProjectByID($proj_id);

?>

<div id="feed-content">

	<div id="head" class="clearfix">
		
		<div id="proj-thumb">
			<img src="../images/<?php echo $project->getProjThumb(); ?>" />
		</div>

		<div id="proj-details">
			<h2><?php echo $project->getProjTitle(); ?></h2>
			<p><?php echo $project->getProjDesc(); ?></p>
		</div>

		<button role="button" id="modal-close"><i class="fa fa-times"></i></button>

	</div>

	<div id="sub" class="clearfix">

		<a href="" rel="<?php echo $project->getUser()->getID(); ?>" class="follow-modal" ><span>Follow</span></a>

		<form method="post" action="." class="report-form">
			<input type="hidden" name="action" value="report" />
            <input type="hidden" name="reported_id" value="<?php echo $project->getUser()->getID(); ?>" />
            <input type="hidden" name="proj_id" value="<?php echo $project->getID(); ?>" />
            <input type="submit" value="Report" class="report" />
		</form>

	</div>

    <div id="content" class="clearfix">

        
        

    </div>

</div><!-- END feed-content -->