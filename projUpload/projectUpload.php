
 <?php
     require_once '../view/header.php';
    require_once '../model/fileupload.php'; 
    require_once '../model/database.php'; 
    
?>


<div id="projUpload">

      <h2>Upload New Project</h2>
    
      
   <form action="processupload.php" method="post" enctype="multipart/form-data">
      
      
    <label id="proj_title" >Project Title : </label>
    <input type="text" name="title" id="title" />
    
    <br /><br />
    
    <label id="proj_description" >Project Description : </label>
    <textarea cols="20" rows="4" name="description" id="description"></textarea>
    
    <br /><br />
    
    
    
    <!--category-->
  
 
       <input type="file" name="upfile" id="upfile" />
       <input type="submit" value="Upload Project to Profile" />
       
       

   </form>

      
</div><!--end projUpload div--> 



<?php 
require_once '../view/footer.php';

?>

    

   
    
    
