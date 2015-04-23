<?php include '../view/header.php'; 
	
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
                                    
                                    <?php

                                        if(!isset($images) or empty($images)) {
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
				<a href="#" class="edit" id="sliderEdit"><i class="fa fa-pencil fa-lg"></i> Edit</a>
			</div>
			<div class="slide-buttons"></div>