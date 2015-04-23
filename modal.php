<?php 

	require './model/autoload.php';

	$id = $_POST['id'];
	$project = HomepageDB::getFeaturedByID($id) ;

?>

<div id="home-content">

    <div id="modal-img">

        <button role="button" id="modal-close"><i class="fa fa-times"></i></button>
        <img src="./images_upload/<?php echo $project['proj_thumb']; ?>" />

    </div><!-- end modal-img -->

</div><!-- END home-content -->