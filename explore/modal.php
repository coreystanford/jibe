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

    <div id="content" class="clearfix">

        
        

    </div>

</div><!-- END modal-content -->