
 <?php require_once '../view/header.php';
       require_once '../model/autoload.php';
 ?>


<div id="projUpload">

      <h2>Upload New Project</h2>
       <br />
       
       <form action="." method="POST" enctype="multipart/form-data">
          
       <input type="hidden" name="action" value="validateProject"/><!--for switch-case in index-->
      
       <label for="categoryDropdown" class="bold-labels">Category: </label>
       <?php echo Functions::displayList("categories", $categories); ?>
       <?php echo $uFields->getField('categories')->getHTML(); ?>
       
       <br />
       
        <label id="proj_title" class="bold-labels">Project Title : </label>
        <input type="text" name="proj_title" id="title" value="<?php echo $title ?>" />
        <?php echo $uFields->getField('proj_title')->getHTML(); ?>
 
        <br />
    
        <label id="proj_description" class="bold-labels" >Project Description : </label>
        <textarea cols="20" rows="4" name="proj_description" id="description" value="<?php echo $description ?>" ></textarea>
        <?php echo $uFields->getField('proj_description')->getHTML(); ?>
    
        <br /><br />
        <label id="proj_thumb" class="bold-labels" >Project Thumbnail : </label>
       <input type="file" name="proj_thumb" id="upfile"/>
       <?php $uFields->getField('proj_thumb')->getHTML(); ?>
       
       <br /><br />
       <input type="submit" value="Proceed to Upload Content" />

   </form>
     
</div><!--end projUpload div--> 

<?php require_once '../view/footer.php'; ?>

    

   
    
    
