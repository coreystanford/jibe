
 <?php require_once '../view/header.php';
       require_once '../model/autoload.php';
 ?>


<div id="projUpload">

      <h2>Upload New Project</h2>
       <br /><br />
       
       <form action="." method="POST" enctype="multipart/form-data">
          
       <input type="hidden" name="action" value="validateProject"/><!--for switch-case in index-->
      
       <label for="categoryDropdown" class="bold-labels">Categories: </label>
       <?php echo Functions::displayList("categories", $categories); ?>
       <?php echo $uFields->getField('categories')->getHTML(); ?>
       
        <label id="proj_title" >Project Title : </label>
        <input type="text" name="proj_title" id="title" value="<?php echo $title ?>" />
        <?php echo $uFields->getField('proj_title')->getHTML(); ?>
 
        <br /><br />
    
        <label id="proj_description" >Project Description : </label>
        <textarea cols="20" rows="4" name="proj_description" id="description" value="<?php echo $description ?>" ></textarea>
        <?php echo $uFields->getField('proj_description')->getHTML(); ?>
    
        <br /><br />

       <input type="file" name="upfile" id="upfile"/>
       <?php $uFields->getField('upfile')->getHTML(); ?>
       
       <input type="submit" value="Upload Project to Profile" />

   </form>
     
</div><!--end projUpload div--> 

<?php require_once '../view/footer.php'; ?>

    

   
    
    
