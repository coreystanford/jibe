<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">
				
                <div class="user clearfix">

                    <div class="photo" >

                        <img src="../../images_upload/profiles/<?php echo $reported->getImgURL(); ?>"  />

                    </div><!-- end photo -->

                    <div class="name">

                        <h1><?php echo $reported->getFName(); ?> <?php echo $reported->getLName(); ?></h1>
                        <h3><?php echo $reported->getSpecialty(); ?></h3>
                        <h4><?php echo $reported->getWebsite(); ?></h4>
                        <h4><?php echo $reported->getCity(); ?>, <?php echo $reported->getCountry(); ?></h4>

                    </div><!-- end name -->

                    <div class="bio">

                        <p><?php echo $reported->getBio(); ?></p>

                    </div><!-- end bio -->

                </div><!-- end user -->

                <div class="cluster">

                    <h1>Delete the profile for <?php echo $reported->getFName(); ?> <?php echo $reported->getLName(); ?>?</h1>

                </div><!-- end cluster -->
                
				<div class="cluster">

					<h3>This cannot be undone.</h3>

				</div><!-- end cluster -->

				<form action="." method="post">

                    <!-- form controller action -->
                    <input type="hidden" name="action" value="confirm-delete-user" />
                    <!-- user id -->
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />

					<div class="cluster">
	                    <input type="submit" class="btn deletebtn" value="Delete" />
	                    <h5><a href="../profiles" class="btn submit">Cancel</a></h5>
	                </div><!-- end cluster -->

                </form><!-- end form -->         

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php'; ?>