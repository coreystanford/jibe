 <?php require_once '../view/header.php';
       require_once '../model/autoload.php';
 ?>

<div class="search-slim"> 
    <div id="projUpdate">

        <h2>Insert Image to New Project</h2>
        <br />

        <form action="." method="POST" enctype="multipart/form-data">

           <input type="hidden" name="action" value="uploadImages"/><!--for switch-case in index-->
           <input type="hidden" name="max_proj_id" value="<?php echo $max_proj_id ?>"/>

            <label id="proj_attribute" class="bold-labels" >Image Attribute : </label>
            <input type="text" name="proj_attribute" id="attribute" value="<?php echo $attribute ?>" ></input>
            <?php echo $iFields->getField('proj_attribute')->getHTML(); ?>

            <br /><br />
           <label id="proj_image" class="bold-labels" >New Image : </label>
           <input type="file" name="proj_image" id="upfile"/>
           <?php $iFields->getField('proj_image')->getHTML(); ?>

           <br /><br />
           <input type="submit" value="Upload Another Image" />

       </form>
            <br />
        <button><a href="../profile/">Finish Project</a></button>
        
    </div><!--end projUpdate div--> 
    
    <div>

        <?php if($images[0]): ?>
        
            <?php foreach($images as $image): ?>

                <img src="../images_upload/projects/<?php echo $image->getURL(); ?>" alt="<?php echo $image->getAttribute(); ?>" />

            <?php endforeach; ?>
        
       <?php else: ?>
            
            <h4>No images in this project yet!</h4>
                
       <?php endif; ?>
            
    </div>
    
</div>
<?php require_once '../view/footer.php'; ?>

