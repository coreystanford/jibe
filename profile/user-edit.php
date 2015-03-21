			

			<div id="user" class="user clearfix">
				<div class="photo" >
					<img src="../images/<?php echo $pro_img; ?>"  />
					<a href="#" class="edit" id="photoEdit" ><i class="fa fa-pencil fa-lg"></i></a>
					<a href="#" class="delete" id="photoDelete"><i class="fa fa-trash-o fa-lg"></i></a>
				</div>
				
				<form action="." method="post">

					<input type="hidden" name="action" value="text-update"/>

					<div class="name">
						<h1><input type="text" name="fname" value="<?php echo $fname; ?>"/> <input type="text" name="lname" value="<?php echo $lname; ?>"/></h1>
						<h3><input type="text" name="specialty" value="<?php echo $specialty; ?>"/></h3>
						<h4><input type="text" name="website" value="<?php echo $website; ?>"/></h4>
						<h4><input type="text" name="city" value="<?php echo $city; ?>" />, <input type="text" name="country" value="<?php echo $country; ?>" /></h4>
					</div>
					<div class="bio">
						<p><textarea type="text" name="bio"  rows="4" cols="50"><?php echo htmlspecialchars($bio); ?></textarea></p>
					</div>

					<div class="cluster">
						<input type="submit" name="submit" value="Update" class="btn submit" />
                		<a href="../profile" class="btn submit">Cancel</a>
					</div>

				</form>

			</div>


					