<?php include '../view/header.php'; ?>

	<div class="slim">

		<div class="cluster">

			<div class="cluster">

				<h1 class="top">Database Error</h1>

			</div><!-- end cluster -->

		    <div class="cluster">

				<p>There was an error connecting to the database.</p>
			    <p>The database must be installed as described in the appendix.</p>
			    <p>MySQL must be running as described in chapter 1.</p>
			    <p>Error message: <?php echo $error_message; ?></p>
			    <p>&nbsp;</p>

			</div><!-- end cluster -->

		</div><!-- end cluster -->

	</div><!-- end slim -->

<?php include '../view/footer.php'; ?>