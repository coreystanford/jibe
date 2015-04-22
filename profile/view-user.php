<?php

	include '../view/header.php'; 

	$followStatus = FollowDB::checkFollow($id, $SESSION_ID);
        
        require_once '../model/autoload.php';
        require_once '../model/sliderImage.php';
        require_once '../model/sliderImageDB.php';
        
        $images;
        if(isset($_GET['id'])) {
            $user_id = $_GET['id'];
            $images = SliderImageDB::getImagesByUser($user_id);
        }

?>

	<section role=main>
		
		<div class="main">
			
		<!-- Slider Section -->

			<div class="slider">
				<div class="slide-group">
					<?php
                                        
                                            if(isset($images) or !empty($images)) {
                                                echo 
                                                    '<div class="slide">'
                                                        .'<img src="../images_upload/slider-images/default.jpg">'
                                                    .'</div>';
                                            }
                                            else {
                                                foreach ($images as $image) {
                                                    echo 
                                                        '<div class="slide">'
                                                            .'<img src="../images_upload/slider-images/'.$image->getImgName().'">'
                                                        .'</div>';
                                                }
                                            }
                                        
                                        ?>
				</div>
			</div>
			<div class="slide-buttons"></div>

		<!-- User Information Section -->

			<div id="user" class="user clearfix">

				<div class="photo" >

					<img src="../images_upload/profiles/<?php echo $pro_img; ?>"  />

				</div><!-- end photo -->

				<div class="name">

					<h1><?php echo $fname; ?> <?php echo $lname; ?></h1>
					<h3><?php echo $specialty; ?></h3>
					<h4><?php echo $website; ?></h4>
					<h4><?php echo $city; ?>, <?php echo $country; ?></h4>

				</div><!-- end name -->

				<div class="bio">

					<p><?php echo $bio; ?></p>

				</div><!-- end bio -->

				<!-- if the session id is 'following' the project creator's id, then display this: -->
				<?php if ($followStatus): ?>
			
					<a href="" rel="<?php echo $id; ?>" class="unfollow-profile" ><span>Following</span></a>

				<!-- else, display this: -->
				<?php else: ?>

					<a href="" rel="<?php echo $id; ?>" class="follow-profile" ><span>Follow</span></a>

				<?php endif ?>
				<!-- end if -->

			</div><!-- end user -->

		<!-- Tab Section -->

			<ul class="tab-list">

				<li class="active"><a class="tab-control" href="#tab-1">Projects</a></li>
				<li><a class="tab-control" href="#tab-2">Activity</a></li>
				<li><a class="tab-control" href="#tab-3">Statistics</a></li>

			</ul><!-- end tab-list -->

			<div class="tab-panel active on" id="tab-1">

				<div class="personal">

					<!-- loop through profile's projects -->
					<?php foreach ($projects as $project) : ?>

						<div class="project">

							<a href="#<?php echo $project->getID(); ?>" title="<?php echo $project->getProjDesc(); ?>"><img src="../images/<?php echo $project->getProjThumb(); ?>" /></a>

							<div class="info">

								<img src="../images/<?php echo $project->getProjThumb(); ?>" class="user-profile" />
								<span class="category" title="<?php echo $project->getCat()->getTitle(); ?>"><i class='fa <?php echo $project->getCat()->getIcon(); ?>'></i></span>
								<span class="approvals"><i class="fa fa-check"></i> 15</span>

							</div><!-- end info -->

						</div><!-- end project -->

					<?php endforeach; ?>
					<!-- end loop -->

				</div><!-- end personal -->

			</div><!-- end tab-panel -->

			<div class="tab-panel on" id="tab-2">

				<div class="activity">
					


				</div><!-- end activity -->

			</div><!-- end tab-panel -->

			<div class="tab-panel on" id="tab-3">

				<div class="stats">
					


				</div><!-- end stats -->

			</div><!-- end tab-panel -->

		</div><!-- END main -->

	</section><!-- END main section -->
	
	<?php include '../view/footer.php'; ?>