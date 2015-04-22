<?php include '../view/header.php'; 

	
	require '../model/autoload.php';
        require_once '../model/sliderImage.php';
        require_once '../model/sliderImageDB.php';
        
	if (!isset($_SESSION)){
        session_start();
    }

    if(!HomepageDB::isLoggedIn()){
        header("Location: ../");
        die();
    }
    
    
    $images;
    if(isset($_GET['id'])) {
        $user_id = $_GET['id'];
        $images = SliderImageDB::getImagesByUser($user_id);
    }
    

?>

	<section role=main>
		
		<div class="main">
			
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