<?php

$first = "";
$last = "";
$email ="";
$password = "";
$phone = "";

$error="";

if(isset($_POST['send'])){
    $email = $_POST['email'];
    if(empty($email)){
        $error .= "Please enter email <br />";
        
    }
    else{
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Valid email";
        }
        else{
            echo "not a valid email";
        }
    }
    
    
    if(strlen($_POST['password']) != 8){
        $error .= "Password must be at least 8 characters. <br />";
    }
    $phone = $_POST['phone'];
    $pattern = "/^[0-9]{8, 12}$/";
    if(!preg_match($pattern,$phone )){
        $error .= "Please enter phone with digits only, no spaces or dashes <br />";
    }      
   
}
?>

<!--------------------------------------------------->


<html>
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
         
  
        <div id="form">
         <h2>Please fill out the form below to sign up for our newsletter</h2>
                
          <?php
     echo $error;
    ?>
    <form action="process.php" method="post">
         
         
         
         
         
         <!--<form action="display_results.php" method="post">-->
             
             
        <fieldset>  
             <label>First Name:</label>
             <input type="text" name="name" value="<?php echo $first; ?>" class="textbox"  />
                   <br />
                   <br />
             <label>Last Name:</label>
             <input type="text" name="name" value="<?php echo $last; ?>" class="textbox" />
             <br />
             <br />
             <label>Email Address: </label>
             <input type="text" name="email" value="<?php echo $email; ?>" class="textbox"/>
                    <br />
                    <br />
            <label>Password: </label>
            <input type="text" name="password" value="" class="textbox" /> 
                    <br />
                    <br />
            <label>Phone Number: </label>
            <input type="text" name="phone" value="<?php echo $phone; ?>" class="textbox" />
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



