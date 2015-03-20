<?php include '../view/header.php'; 

if(!isset($category)){
    header('Location: ../categories');
}

?>

    <section role=main>

        <div class="main-admin">

            <h1>Edit <?php echo $category->getTitle(); ?></h1>

            <form method="post" action="." >
            
                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="id" value="<?php echo $category->getID(); ?>">

                <div class="cluster">

                    <label for="updtitle" class="bold-labels">Title: </label>
                    <input type="text" name="updtitle" value="<?php echo htmlspecialchars($title); ?>"><?php echo $updfields->getField('updtitle')->getHTML(); ?>

                    <label for="upddesc" class="bold-labels">Description: </label>
                    <input type="text" name="upddesc" value="<?php echo htmlspecialchars($desc); ?>"><?php echo $updfields->getField('upddesc')->getHTML(); ?>

                    <label for="updicon" class="bold-labels">Icon: </label>
                    <input type="text" name="updicon" value="<?php echo htmlspecialchars($icon); ?>"><?php echo $updfields->getField('updicon')->getHTML(); ?>

                    <br />
                    <br />
                    <input type="submit" name="submit" value="Update" />
                     <br />
                     <br />
                    <h5><a href="../categories">Cancel</a></h5>

                </div>

            </form>

        </div>

    </section>

<?php include '../view/footer.php'; ?>