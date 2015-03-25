			

			<div id="user" class="user clearfix">
				<div class="photo" >
					<img src="../images/<?php echo $pro_img; ?>"  />
					<a href="#modal" class="edit" id="photoEdit" rel="<?php echo $id ?>"><i class="fa fa-pencil fa-lg"></i></a>
					<a href="#modal" class="delete" id="photoDelete" rel="<?php echo $id ?>"><i class="fa fa-trash-o fa-lg"></i></a>
				</div>
				
				<form action="." method="post">

					<input type="hidden" name="action" value="user-update"/>

					<div class="name">
						<h1><input type="text" name="fname" value="<?php echo htmlspecialchars($fname); ?>"/> <input type="text" name="lname" value="<?php echo htmlspecialchars($lname); ?>"/></h1>
						<h3><input type="text" name="specialty" value="<?php echo htmlspecialchars($specialty); ?>"/></h3>
						<h4><input type="text" name="website" value="<?php echo htmlspecialchars($website); ?>"/></h4>
						<h4><input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" />, <input type="text" name="country" value="<?php echo htmlspecialchars($country); ?>" /></h4>
					</div>
					<div class="bio">
						<p><textarea type="text" name="bio"  rows="4" cols="50"><?php echo htmlspecialchars($bio); ?></textarea></p>
					</div>

					<div class="cluster">
						<input type="submit" name="submit" value="Update" class="btn submit" />
                		<a href="../profile/?id=<?php echo $SESSION_ID; ?>" class="btn submit">Cancel</a>
					</div>

				</form>

			</div>


					