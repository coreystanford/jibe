<?php include '../view/header.php'; ?>

	<section role=main>

		<div class="main-admin">
			<div class="cat-container">

				<h1>Feeds</h1>

					<form method="post" action="." >
					<input type="hidden" name="action" value="update-feeds" />

						<div class="cluster">
							
							<div class="cluster-left">
								
								<h2>Projects Per Load: </h2>
								<div class="cluster">
									<input type="text" name="limit" value="<?php echo $limit; ?>" />
								</div>
							</div>
							<div class="cluster-left">
								
								<h2>Number of Loads: </h2>
								<div class="cluster">
									<input type="text" name="loads" value="<?php echo $loads; ?>" />
								</div>
							</div>
							<div class="cluster">
								
								<input type="submit" name="submit" value="Update" class="btn submit fullwidth" />

							</div>

						</div>

					</form>

			</div><!-- END cat-container -->

		</div><!-- END main-admin -->

	</section><!-- END main section -->

<?php include '../view/footer.php';