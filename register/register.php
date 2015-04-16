   <?php 
        include '../view/anonymous-header.php'; 
        ?>

<div id="register" >
      <form action="." method="POST">
        
          <input type="hidden" name="action" value="new_user"/><!--for case in index-->
          
          
        <label id="email">Email:</label>
        <input name="email" type="text" id="email" value="<?php echo $email; ?>">
       <?php echo $rFields->getField('email')->getHTML(); ?>
        
            <br/><br/>
        <label id="password">Create a Password:</label>
        <input name="password" type="password" id="password" value="<?php echo $password; ?>">
      <?php echo $rFields->getField('password')->getHTML(); ?>
        
            <br/><br/>
        <label id="confirmPassword">Confirm Password:</label>
        <input name="confirmPassword" type="password" id="confirmPassword" value="<?php echo $confirmPassword; ?>">
       <?php echo $rFields->getField('confirmPassword')->getHTML(); ?>
        
          <br/><br/>
          <label id="fname">First Name:</label>
          <input name="fname" type="text" id="fname" value="<?php echo $fname; ?>">
          <?php echo $rFields->getField('fname')->getHTML(); ?>
          
          <br /><br />
          <label id="lname">Last Name:</label>
          <input name="lname" type="text" id="lname" value="<?php echo $lname; ?>">
         <?php echo $rFields->getField('lname')->getHTML(); ?>
          <br /><br />
        
         <input type="submit" name="submit" value="Register">
       </form><!--end register form-->


       
</div><!--end register div-->

  <?php 
        include '../view/anonymous-footer.php'; 
        ?>