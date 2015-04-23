<?php include '../view/header.php'; ?>

<div id="slider-main" class="search-slim">

    <h2>Setup your image slider</h2>
    
    <div id="img-upload">
        <form action="." method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="validate-image"/><!--for switch-case in index-->
            <label id="lbl-add-image" class="bold-labels" >Choose an image</label>
            <input type="file" name="image_input" id="image_input"/>
            <?php echo $iFields->getField('image_input')->getHTML(); ?>
            <br /><br />
            <input type="submit" name="send" value="Proceed to Upload Content" />
        </form>
    </div>    
    
    <div id="imgs-uploaded">
        
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
                        .'</li>';
                }
            }

        ?>
            
        </ul>
        
    </div>

</div>

<?php include '../view/footer.php'; ?>