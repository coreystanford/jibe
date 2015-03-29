	<div id="user" class="user clearfix">

		<div class="photo" >

			<img src="../images_upload/profiles/<?php echo $pro_img; ?>"  />
			<a href="#modal" class="edit" id="photoEdit" rel="<?php echo $id; ?>"><i class="fa fa-pencil fa-lg"></i></a>
			<a href="#modal" class="delete" id="photoDelete" rel="<?php echo $id; ?>"><i class="fa fa-trash-o fa-lg"></i></a>

		</div><!-- end photo -->
		
		<form action="./#user" method="post">

			<input type="hidden" name="action" value="user-update"/>

			<div class="name">

				<h1><input type="text" name="fname" placeholder="First Name" value="<?php echo htmlspecialchars($fname); ?>"/>
				<!-- validation message -->
				<?php echo $textfields->getField('fname')->getHTML(); ?> 
				<input type="text" name="lname" placeholder="Last Name" value="<?php echo htmlspecialchars($lname); ?>"/></h1>
				<!-- validation message -->
				<?php echo $textfields->getField('lname')->getHTML(); ?>

				<h3><input type="text" name="specialty" placeholder="Specialty" value="<?php echo htmlspecialchars($specialty); ?>"/></h3>
				<!-- validation message -->
				<?php echo $textfields->getField('specialty')->getHTML(); ?>

				<h4><input type="text" name="website" placeholder="Website URL" value="<?php echo htmlspecialchars($website); ?>"/></h4>
				<!-- validation message -->
				<?php echo $textfields->getField('website')->getHTML(); ?>

				<h4><input type="text" name="city" placeholder="City" value="<?php echo htmlspecialchars($city); ?>" />, 
				<!-- validation message -->
				<?php echo $textfields->getField('city')->getHTML(); ?>

				<input type="text" name="country" placeholder="Country" value="<?php echo htmlspecialchars($country); ?>" /></h4>
				<!-- validation message -->
				<?php echo $textfields->getField('country')->getHTML(); ?>

			</div><!-- end name -->

			<div class="bio">

				<p><textarea type="text" name="bio"  rows="4" cols="50" placeholder="Personal Bio"><?php echo htmlspecialchars($bio); ?></textarea></p>
				<!-- validation message -->
				<?php echo $textfields->getField('bio')->getHTML(); ?>

			</div><!-- end bio -->

			<div class="cluster">
				<input type="submit" name="submit" value="Update" class="btn submit" />
        		<a href="../profile/?id=<?php echo $SESSION_ID; ?>#user" class="btn submit">Cancel</a>
			</div><!-- end cluster -->

		</form><!-- end form -->

	</div><!-- end user -->