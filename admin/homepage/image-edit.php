				

				<div id="featured-img" class="clearfix">

					<form action="." method="post" enctype="multipart/form-data">

						<input type="hidden" name="action" value="image-update"/>

						<h2>Featured Image: </h2>

						<img src="../../images/<?php echo $img; ?>" />

						<div class="cluster">
							<input type="file" name="main-img"/>
						</div>

						<div class="cluster">
							<input type="submit" name="submit" value="Update" class="btn submit" />
                    		<a href="../homepage#featured-img" class="btn submit">Cancel</a>
						</div>

					</form>
					
				</div>