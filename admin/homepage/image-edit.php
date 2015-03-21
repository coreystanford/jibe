				

				<div id="featured-img" class="clearfix">

					<form action="." method="post">

						<input type="hidden" name="action" value="img-update"/>

						<h2>Featured Image: </h2>

						<img src="../images/featured1.jpg" />

						<input type="text" name="main-img" value="featured1.jpg"/>
						<?php echo $textfields->getField('btn-link')->getHTML(); ?>

						<div class="cluster">
							<input type="submit" name="submit" value="Insert" class="btn submit" />
                    		<a href="../categories" class="btn submit">Cancel</a>
						</div>

					</form>
					
				</div>