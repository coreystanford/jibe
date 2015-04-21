 <?php require_once '../view/header.php';
       require_once '../model/autoload.php';
 ?>


<div id="projUpdate">

      <h2>Upload New Project</h2>
       <br />
       
       <form action="." method="POST" enctype="multipart/form-data">
          
       <input type="hidden" name="action" value="uploadImages"/><!--for switch-case in index-->
       <input type="hidden" name="max_proj_id" value="<?php echo $max_proj_id ?>"/>
    
        <label id="proj_attribute" class="bold-labels" >Project Attribute : </label>
        <textbox name="proj_attribute" id="attribute" value="<?php echo $attribute ?>" ></textbox>
        <?php echo $iFields->getField('proj_attribute')->getHTML(); ?>
    
        <br /><br />

       <input type="file" name="proj_image" id="upfile"/>
       <?php $iFields->getField('proj_image')->getHTML(); ?>
       
       <br /><br />
       <input type="submit" value="Upload Another Image" /> <input type="submit" value="Finish Project" />

   </form>
     
</div><!--end projUpdate div--> 

<?php require_once '../view/footer.php'; ?>

