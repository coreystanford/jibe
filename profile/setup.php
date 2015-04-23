<?php 

include '../view/header.php'; 

if (!isset($_SESSION)){
      session_start();
  }
  if(!HomepageDB::isLoggedIn()){
      header("Location: ../");
      die();
  }
if(isset($_SESSION['user_id'])){
    $SESSION_ID = $_SESSION['user_id'];
}

?>

    <div class="slim">

      <h2>Add your profile image and information</h2>

      

      <form action="." method="post" enctype="multipart/form-data">

        <!-- form controller action -->
        <input type="hidden" name="action" value="submit-setup">

        <div class="cluster">

          <input type="file" name="pro_thumb" />

        </div><!-- end cluster -->

        <div class="name">

          <input type="hidden" name="fname" value="<?php echo $fname ?>"/>
          <input type="hidden" name="lname" value="<?php echo $lname ?>"/>

          <h3 class="labels">Specialty: </h3>
          <h3><input type="text" name="specialty" value="<?php echo htmlspecialchars($specialty); ?>"/></h3>
          <!-- validation message -->
          <?php echo $textfields->getField('specialty')->getHTML(); ?>

          <h3 class="labels">Website: </h3>
          <input type="text" name="website" value="<?php echo htmlspecialchars($website); ?>"/>
          <!-- validation message -->
          <?php echo $textfields->getField('website')->getHTML(); ?>

          <h3 class="labels">City: </h3>
          <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" /> 
          <!-- validation message -->
          <?php echo $textfields->getField('city')->getHTML(); ?>

          <h3 class="labels">Country: </h3>
          <input type="text" name="country" value="<?php echo htmlspecialchars($country); ?>" />
          <!-- validation message -->
          <?php echo $textfields->getField('country')->getHTML(); ?>

        </div><!-- end name -->

        <div class="bio">

          <h3 class="labels">Short Bio: </h3>
          <p><textarea type="text" name="bio"  rows="4" cols="50"><?php echo htmlspecialchars($bio); ?></textarea></p>
          <!-- validation message -->
          <?php echo $textfields->getField('bio')->getHTML(); ?>

        </div><!-- end bio -->

        <div class="cluster">
          <input type="submit" name="submit" value="Proceed" class="btn submit" />
        </div><!-- end cluster -->

      </form><!-- end form -->
    </div>

<?php include '../view/footer.php'; ?>