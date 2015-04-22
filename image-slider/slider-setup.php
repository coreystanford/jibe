<?php include '../view/header.php'; ?>

<div id="slider-main" class="search-slim">

    <h2>Setup your image slider</h2>
    
    <form action="." method="POST" enctype="multipart/form-data">

        <input type="hidden" name="action" value="validate-image"/><!--for switch-case in index-->

        <label id="lbl-add-image" class="bold-labels" >Add an image : </label>
        <input type="file" name="image_input" id="image_input"/>
        <?php echo $iFields->getField('image_input')->getHTML(); ?>
        <br /><br />
        <input type="submit" name="send" value="Proceed to Upload Content" />

    </form>    

</div>

<?php include '../view/footer.php'; ?>