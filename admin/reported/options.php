<?php include '../view/header.php'; 



?>

    <section role=main>

        <div class="main-admin">

            <div class="report-container">

                <h1>Reports</h1>
                
                <a href="." class="resolved"><i class="fa fa-arrow-left fa-lg"></i>  Back</a>

                <div class="cluster">
                    <h2>Report ID: <?php echo $id; ?></h2>
                </div>

                <div class="cluster">
                    <h3>Reported User:</h3>
                    <p><?php echo $reported->getFName(); ?> <?php echo $reported->getLName(); ?></p>
                </div>
                <div class="cluster">
                    <h3>Reported Project:</h3>
                    <p><?php echo $project->getProjTitle(); ?></p>
                    <p><?php echo $project->getProjDesc(); ?></p>
                </div>
                <div class="cluster">
                    <h3>Reported By:</h3>
                    <p><?php echo $reporter->getFName(); ?> <?php echo $reporter->getLName(); ?></p>
                </div>             

            </div>

        </div><!-- END main-admin -->

    </section><!-- END main section -->

<?php include '../view/footer.php'; ?>