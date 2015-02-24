		<?php include '../view/header.php'; ?>

		<section role=main>
			
			<div class="main">
				
				<div class="slider">
					<div class="slide-group">
						<div class="slide">
							<img src="../images/slide2.jpg">
						</div>
						<div class="slide">
							<img src="../images/slide1.jpg">
						</div>
						<div class="slide">
							<img src="../images/slide3.jpg">
						</div>
						<div class="slide">
							<img src="../images/slide4.jpg">
						</div>
					</div>
					<a href="#" class="edit" id="sliderEdit"><i class="fa fa-pencil fa-lg"></i> Edit</a>
				</div>
				<div class="slide-buttons"></div>

				<div class="user clearfix">
					<div class="photo" >
						<img src="../images/profile1lg.jpg"  />
						<a href="#" class="edit" id="photoEdit" ><i class="fa fa-pencil fa-lg"></i></a>
						<a href="#" class="delete" id="photoDelete"><i class="fa fa-trash-o fa-lg"></i></a>
					</div>
					<div class="name">
						<h1>George Turing</h1>
						<h3>Web Developer</h3>
						<h4>www.georgeturing.com</h4>
						<h4>Toronto, ON</h4>
					</div>
					<div class="bio">
						<p>I'm a self proclaimed minimalist, with solipsistic leanings. An empiricist at heart, this viewpoint explains the solipsism, though it's rarely connected. This lack of interest often triggers an existential experience.</p>
					</div>
					<a href="#" class="edit" id="profileEdit" ><i class="fa fa-pencil fa-lg"></i> Edit Profile</a>
				</div>
				<ul class="tab-list">
					<li class="active"><a class="tab-control" href="#tab-1">Projects</a></li>
					<li><a class="tab-control" href="#tab-2">Activity</a></li>
					<li><a class="tab-control" href="#tab-3">Statistics</a></li>
				</ul>
				<div class="tab-panel active on" id="tab-1">
					<div class="personal">

						<div class="project own">
							<a href="#" title="This is some popup content. We need to test for word breaks wherever we can."><img src="../images/web1.1.jpg" /></a>
							<div class="info">
								<a href="#" class="edit" ><i class="fa fa-pencil fa-lg"></i></a>
								<a href="#" class="delete"><i class="fa fa-trash-o fa-lg"></i></a>
								<span class="approvals"><i class="fa fa-check"></i> 1020</span>
							</div>
						</div>

						<div class="project own">
							<a href="#" title="This is some popup content. We need to test for word breaks wherever we can. Another user might write some more than another"><img src="../images/web2.1.jpg" /></a>
							<div class="info">
								<a href="#" class="edit" ><i class="fa fa-pencil fa-lg"></i></a>
								<a href="#" class="delete"><i class="fa fa-trash-o fa-lg"></i></a>
								<span class="approvals"><i class="fa fa-check"></i> 1020</span>
							</div>
						</div>

						<div class="project own">
							<a href="#" title="This is some popup content. We need to test for word breaks wherever we can. Another user might write some more than another"><img src="../images/web3.1.jpg" /></a>
							<div class="info">
								<a href="#" class="edit" ><i class="fa fa-pencil fa-lg"></i></a>
								<a href="#" class="delete"><i class="fa fa-trash-o fa-lg"></i></a>
								<span class="approvals"><i class="fa fa-check"></i> 300</span>
							</div>
						</div>
						<div class="project own">
							<a href="#" title="This is some popup content. We need to test for word breaks wherever we can. Another user might write some more than another. This is some popup content. We need to test for word breaks wherever we can. Another user might write some more than another"><img src="../images/web4.1.jpg" /></a>
							<div class="info">
								<a href="#" class="edit" ><i class="fa fa-pencil fa-lg"></i></a>
								<a href="#" class="delete"><i class="fa fa-trash-o fa-lg"></i></a>
								<span class="approvals"><i class="fa fa-check"></i> 0</span>
							</div>
						</div>
						<div class="project own">
							<a href="#" title="This is some popup content. We need to test for word breaks wherever we can. Another user might write some more than another"><img src="../images/web5.1.jpg" /></a>
							<div class="info">
								<a href="#" class="edit" ><i class="fa fa-pencil fa-lg"></i></a>
								<a href="#" class="delete"><i class="fa fa-trash-o fa-lg"></i></a>
								<span class="approvals"><i class="fa fa-check"></i> 467</span>
							</div>
						</div>
						<div class="project own">
							<a href="#" title="This is some popup content. We need to test for word breaks wherever we can. Another user might write some more than another"><img src="../images/web6.1.jpg" /></a>
							<div class="info">
								<a href="#" class="edit" ><i class="fa fa-pencil fa-lg"></i></a>
								<a href="#" class="delete"><i class="fa fa-trash-o fa-lg"></i></a>
								<span class="approvals"><i class="fa fa-check"></i> 56</span>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-panel on" id="tab-2">
					<div class="activity">
						
					</div>
				</div>
				<div class="tab-panel on" id="tab-3">
					<div class="stats">
						
					</div>
				</div>

			</div>
			</div>

		</section><!-- END main section -->
		
		<?php include '../view/footer.php'; ?>