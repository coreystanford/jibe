<?php include '../view/header.php'; ?>

    <section role=main>

        <div class="main-admin">

            <h1>Edit <?php echo $title; ?></h1>

            <form method="post" action="." >
            
                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="cluster">

                    <label for="title" class="bold-labels">Title: </label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" /><?php echo $fields->getField('title')->getHTML(); ?>

                    <label for="desc" class="bold-labels">Description: </label>
                    <textarea type="text" name="desc"  rows="4" cols="50"><?php echo htmlspecialchars($desc); ?></textarea>
                    <?php echo $fields->getField('desc')->getHTML(); ?>

                    <label for="icon" class="bold-labels">Icon: </label>
                    <input type="text" name="icon" value="<?php echo htmlspecialchars($icon); ?>" /><?php echo $fields->getField('icon')->getHTML(); ?>

                </div>
                
                <div class="cluster">
                    <input type="submit" name="submit" value="Update" class="btn submit" />
                    <h5><a href="../categories" class="btn submit">Cancel</a></h5>
                </div>

            </form>

        </div>

    </section>

<?php include '../view/footer.php'; ?>