<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <!-- Info -->
  <title>PHP Project</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
  <!-- Icons -->
  <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
  <!-- Style -->
  <link rel="stylesheet" href="../css/style.css">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="../images/favicon.png">
</head>

	<body>

		<div id="wrapper">

      <div class="photo" >

        <img src="../images_upload/profiles/<?php echo $pro_img; ?>"  />
        <a href="#modal" class="edit" id="photoEdit" rel="<?php echo $id; ?>"><i class="fa fa-pencil fa-lg"></i></a>
        <a href="#modal" class="delete" id="photoDelete" rel="<?php echo $id; ?>"><i class="fa fa-trash-o fa-lg"></i></a>

      </div><!-- end photo -->
      
      <form action="./#user" method="post">

        <input type="hidden" name="action" value="user-update"/>

        <div class="name">

          <h1><input type="text" name="fname" placeholder="First Name" value="<?php echo htmlspecialchars($fname); ?>"/>
          <!-- validation message -->
          <?php echo $textfields->getField('fname')->getHTML(); ?> 
          <input type="text" name="lname" placeholder="Last Name" value="<?php echo htmlspecialchars($lname); ?>"/></h1>
          <!-- validation message -->
          <?php echo $textfields->getField('lname')->getHTML(); ?>

          <h3><input type="text" name="specialty" placeholder="Specialty" value="<?php echo htmlspecialchars($specialty); ?>"/></h3>
          <!-- validation message -->
          <?php echo $textfields->getField('specialty')->getHTML(); ?>

          <h4><input type="text" name="website" placeholder="Website URL" value="<?php echo htmlspecialchars($website); ?>"/></h4>
          <!-- validation message -->
          <?php echo $textfields->getField('website')->getHTML(); ?>

          <h4><input type="text" name="city" placeholder="City" value="<?php echo htmlspecialchars($city); ?>" />, 
          <!-- validation message -->
          <?php echo $textfields->getField('city')->getHTML(); ?>

          <input type="text" name="country" placeholder="Country" value="<?php echo htmlspecialchars($country); ?>" /></h4>
          <!-- validation message -->
          <?php echo $textfields->getField('country')->getHTML(); ?>

        </div><!-- end name -->

        <div class="bio">

          <p><textarea type="text" name="bio"  rows="4" cols="50" placeholder="Personal Bio"><?php echo htmlspecialchars($bio); ?></textarea></p>
          <!-- validation message -->
          <?php echo $textfields->getField('bio')->getHTML(); ?>

        </div><!-- end bio -->

        <div class="cluster">
          <input type="submit" name="submit" value="Update" class="btn submit" />
              <a href="../profile/?id=<?php echo $SESSION_ID; ?>#user" class="btn submit">Cancel</a>
        </div><!-- end cluster -->

      </form><!-- end form -->


    </div><!-- end wrapper -->

    <footer class="clearfix">

      <nav>

        <ul>
          <li><a href="#">Site Map</a></li>
          <li><a href="#">Terms of Use</a></li>
          <li><a href="#">Privacy Policy</a></li>
        </ul>

      </nav><!-- end nav -->

      <p>&copy;<?php echo date('Y'); ?> JIBE | All Rights Reserved</p>
        
    </footer><!-- end footer -->

    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../js/logo.js"></script>
    <script type="text/javascript" src="../js/slider.js"></script>
    <script type="text/javascript" src="../js/tab.js"></script>
    <script type="text/javascript" src="../js/feed-modal.js"></script>
    <script type="text/javascript" src="../js/feed-modal-init.js"></script>
    <script type="text/javascript" src="../js/profile-follow.js"></script>
    <script type="text/javascript" src="../js/img-modal.js"></script>
    <script type="text/javascript" src="../js/job-board.js"></script>

  </body><!-- end body -->
  
</html><!-- end html -->