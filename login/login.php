        <?php 
        include './view/anonymous-header.php'; 
        ?>

<div id="login" >
    

        <form action="." method="POST">
        
        <input type="hidden" name="action" value="login"/><!--for switch-case in index-->
        
        <?php echo $lFields->getField('invalid')->getHTML(); ?>
        
        <label id="email">Email:</label>
        <input name="email" type="text" id="email" value="<?php echo $email ?>" />
        <?php echo $lFields->getField('email')->getHTML(); ?>
            
            <br/><br/>
        
        <label id="password">Password:</label>
        <input name="password" type="password" id="password" value="<?php echo $password ?>" />
        <?php echo $lFields->getField('password')->getHTML(); ?>
        
            <br/><br/>
        
         <input type="submit" name="submit" value="Login">
       </form><!--end login form-->
       <br /><br />

       


    
</div><!--end login div-->

  <?php 
        include './view/anonymous-footer.php'; 
        ?>