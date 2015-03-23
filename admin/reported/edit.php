<?php include '../view/header.php'; 



?>

    <section role=main>

        <div class="main-admin">

            <h1>Edit <?php echo $category->getTitle(); ?></h1>

            <form method="post" action="." >
            
                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="id" value="<?php echo $category->getID(); ?>">

                <div class="cluster">

                    <label for="updtitle" class="bold-labels">Reporter: </label>
                    <input type="text" name="updtitle" value="<?php echo htmlspecialchars($title); ?>">

                    <label for="upddesc" class="bold-labels">Reported: </label>
                    <input type="text" name="upddesc" value="<?php echo htmlspecialchars($desc); ?>">

                    <label for="updicon" class="bold-labels">Reported Project: </label>
                    <input type="text" name="updicon" value="<?php echo htmlspecialchars($icon); ?>">


                    <div class="cluster">
                        <input type="submit" name="submit" value="Update" class="btn submit" />
                        <h5><a href="../categories" class="btn submit">Cancel</a></h5>
                    </div>

                </div>

            </form>

        </div>

    </section>

<?php include '../view/footer.php'; ?>