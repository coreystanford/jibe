<?php include '../view/header.php'; 

if(!isset($_POST['submit'])){
        $title = "";
        $desc = "";
        $icon = "";
    }

?>

    <section role=main>

        <div class="main-admin">

            <h1>Insert a New Category</h1>

            <form method="post" action="." >

                <input type="hidden" name="action" value="commit-insert" />

                <div class="cluster">
                    <label for="institle" class="bold-labels">Title: </label>
                    <input type="text" name="institle" value="<?php echo htmlspecialchars($title); ?>"><?php echo $insfields->getField('institle')->getHTML(); ?>

                    <label for="insdesc" class="bold-labels">Description: </label>
                    <input type="text" name="insdesc" value="<?php echo htmlspecialchars($desc); ?>"><?php echo $insfields->getField('insdesc')->getHTML(); ?>

                    <label for="insicon" class="bold-labels">Icon: </label>
                    <input type="text" name="insicon" value="<?php echo htmlspecialchars($icon); ?>"><?php echo $insfields->getField('insicon')->getHTML(); ?>

                    <br />
                    <br />
                    <input type="submit" name="submit" value="Insert" />
                    <br />
                    <br />
                    <h5><a href="../categories">Cancel</a></h5>
                </div>

            </form>

        </div>

    </section>

<?php include '../view/footer.php'; ?>