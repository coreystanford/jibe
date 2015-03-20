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
                    <label for="title" class="bold-labels">Title: </label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($category->getTitle()); ?>"><?php echo $fields->getField('title')->getHTML(); ?>

                    <label for="desc" class="bold-labels">Description: </label>
                    <input type="text" name="desc" value="<?php echo htmlspecialchars($category->getDesc()); ?>"><?php echo $fields->getField('desc')->getHTML(); ?>

                    <label for="icon" class="bold-labels">Icon: </label>
                    <input type="text" name="icon" value="<?php echo htmlspecialchars($category->getIcon()); ?>"><?php echo $fields->getField('icon')->getHTML(); ?>

                    <br />
                    <br />
                    <input type="submit" name="submit" value="Submit" />
                     <br />
                     <br />
                    <h5><a href="../categories">Cancel</a></h5>
                </div>

            </form>

        </div>

    </section>

<?php include '../view/footer.php'; ?>