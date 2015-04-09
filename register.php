   <?php 
        include './view/anonymous-header.php'; 
        ?>

<div id="register" >
    

      <form action="." method="POST">
        
          <input type="hidden" name="action" value="new_user"/><!--for case in index-->
          
          
        <label id="email">Email:</label>
        <input name="email" type="text" id="email">
       
        
            <br/><br/>
        <label id="password">Create a Password:</label>
        <input name="password" type="password" id="password">
      
        
            <br/><br/>
        <label id="confirmPassword">Confirm Password:</label>
        <input name="confirmPassword" type="password" id="confirmPassword">
       
        
          <br/><br/>
          <label id="fname">First Name:</label>
          <input name="fname" type="text" id="fname">
          
          
          <br /><br />
          <label id="lname">Last Name:</label>
          <input name="lname" type="text" id="lname">
         
          <br /><br />
        
         <input type="submit" name="Submit" value="Register">
       </form><!--end register form-->

<!--       <h2>Are you already a member?</h2>
       <br />
       <h2><a href="login.php">Login</a></h2>-->
       
</div><!--end register div-->

  <?php 
        include './view/anonymous-footer.php'; 
        ?>