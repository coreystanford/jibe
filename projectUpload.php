<div id="projUpload">

      <h2>Project Upload</h2>
    
    <label id="proj_title" >Project Title</label>
    <input type="text" name="title" id="title" />
    
    <br />
    
    <label id="proj_description" >Project Description</label>
    <input type="textarea" name="description" id="description" />
    
    <br /><br />
    
   
    
   <form action="processupload.php" method="post" enctype="multipart/form-data">
       <input type="file" name="upfile" id="upfile" />
       <input type="submit" value="upload" />

   </form>

</div><!--end projUpload div--> 

    

   
    
    
