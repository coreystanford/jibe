<?php 
require './model/database.php';
require './model/homepageDB.php';

$id = $_POST['id'];
$project = HomepageDB::getFeaturedByID($id) ;

?>

<div id="modal-content">

    <div id="modal-img">
        <button role="button" id="modal-close"><i class="fa fa-times"></i></button>
        <img src="./images/<?php echo $project['proj_thumb']; ?>" />
    </div>

</div><!-- END modal-content -->