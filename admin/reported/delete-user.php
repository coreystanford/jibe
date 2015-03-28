<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">
				
                <div class="user clearfix">

                    <div class="photo" >
                        <img src="../../images/<?php echo $reported->getImgURL(); ?>"  />
                    </div>
                    <div class="name">
                        <h1><?php echo $reported->getFName(); ?> <?php echo $reported->getLName(); ?></h1>
                        <h3><?php echo $reported->getSpecialty(); ?></h3>
                        <h4><?php echo $reported->getWebsite(); ?></h4>
                        <h4><?php echo $reported->getCity(); ?>, <?php echo $reported->getCountry(); ?></h4>
                    </div>
                    <div class="bio">
                        <p><?php echo $reported->getBio(); ?></p>
                    </div>

                </div>

                <div class="cluster">
                    <h1>Delete the profile for <?php echo $reported->getFName(); ?> <?php echo $reported->getLName(); ?>?</h1>
                </div>
                

				<div class="cluster">
					<h3>This cannot be undone.</h3>
				</div>

				<form action="." method="post" id="delete_form">
					<div class="cluster">
	                    <input type="hidden" name="action" value="confirmed-delete-user" />
	                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	                    <input type="submit" class="btn deletebtn" value="Delete" />
	                    <h5><a href="../reported" class="btn submit">Cancel</a></h5>
	                </div>
                </form>                

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';