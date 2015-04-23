<?php include '../view/header.php'; ?>
<?php
/*
    Author: Wilston Dsouza
    This files is the view page for the image slider set up.
    Lets user add images to the silder of their profile page
    or delete already existing ones from it.
*/
?>
<div id="slider-main" class="search-slim">
    <br/>
    <h2>Setup your image slider</h2>
    <br/>
    <div id="img-upload">
        <form action="." method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="validate-image"/><!--for switch-case in index-->
            Choose an image: 
            <input type="file" name="image_input" id="image_input"/>
            <?php echo $iFields->getField('image_input')->getHTML(); ?>
            <br /><br />
            <input type="submit" name="send" class="btn submit-btn" value="Upload" /><a href="../profile/" class="btn submit-btn">Exit</a>
        </form>
        <br/>
    </div>    
    
    <div id="imgs-uploaded">
        
        <h2>Existing Images</h2>
        <br/><br/>
        <ul>
        
        <?php
            
        
            if(!isset($images) or empty($images)) {
                echo '<li>No images added yet</li>';
            }
            else {
                foreach ($images as $image) {
                    echo 
                        '<li>'
                            .'<img src="../images_upload/slider-images/'.$image->getImgName().'">'
                            .'<form method="post" action="." class="delete-form">'
                                .'<input type="hidden" name="action" value="delete-image" />'
                                .'<input type="hidden" name="img_id" value="'.$image->getID().'" />'
                                .'<input type="submit" name="delete" value="Delete" class="btn submit-btn delete-btn" />'
                            .'</form>'
                        .'</li>';
                }
            }

        ?>
            
        </ul>
        
    </div>

</div>

<?php include '../view/footer.php'; ?>