	

			<div id="user" class="user clearfix">
				<div class="photo" >
					<img src="../images/<?php echo $pro_img; ?>"  />
					<a href="#" class="edit" id="photoEdit" ><i class="fa fa-pencil fa-lg"></i></a>
					<a href="#" class="delete" id="photoDelete"><i class="fa fa-trash-o fa-lg"></i></a>
				</div>
				<div class="name">
					<h1><?php echo $fname; ?> <?php echo $lname; ?></h1>
					<h3><?php echo $specialty; ?></h3>
					<h4><?php echo $website; ?></h4>
					<h4><?php echo $city; ?>, <?php echo $country; ?></h4>
				</div>
				<div class="bio">
					<p><?php echo $bio; ?></p>
				</div>
				<a href="./?action=user-edit#user" class="edit" id="profileEdit" ><i class="fa fa-pencil fa-lg"></i> Edit Profile</a>
			</div>
			