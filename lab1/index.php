<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Style.css">
        <title>Make an account with us!</title>
    </head>
    
    <body>
        
        <div id="header">
        <?php include "header.php";   ?>
        </div>
   <!------------------------------------------------------------>
       
   
       <?php
     if(isset($_POST['err'])){
        echo $_POST['err'];
     }
   ?>
   
   
        <div id="form">
         <h2>Please fill out the form below to sign up for our newsletter</h2>
              
         
       
         <form action="display_results.php" method="post">
             
             
        <fieldset>  
             <label>First Name:</label>
             <input type="text" name="name" value="" class="textbox"  />
                   <br />
                   <br />
             <label>Last Name:</label>
             <input type="text" name="name" value="" class="textbox" />
             <br />
             <br />
             <label>Email Address: </label>
             <input type="text" name="email" value="" class="textbox"/>
                    <br />
                    <br />
            <label>Password: </label>
            <input type="text" name="password" value="" class="textbox" /> 
                    <br />
                    <br />
            <label>Phone Number: </label>
            <input type="text" name="phone" value="" class="textbox" />
                    <br />
                    <br />
            <input type="submit" value="Submit" name="send" />
         </fieldset>
         </form>
        </div>
      <!----------------------------------->
        <div id="footer">
        <?php include "footer.php"; ?>
        </div>
   
   
    </body>
</html>
