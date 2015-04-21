<?php include '../view/header.php'; 

	
	require '../model/autoload.php';
	if (!isset($_SESSION)){
        session_start();
    }

    if(!HomepageDB::isLoggedIn()){
        header("Location: ../");
        die();
    }

?>

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