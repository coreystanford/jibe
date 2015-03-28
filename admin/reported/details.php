<?php include '../view/header.php'; ?>

    <section role=main>

        <div class="main-admin">

            <div class="report-container">

                <h1>Reports</h1>
                
                <a href="." class="resolved"><i class="fa fa-arrow-left fa-lg"></i>  Back</a>

                <div class="cluster-center">
                    <h3>Report ID: <?php echo $id; ?></h3>
                </div>

                <div class="cluster-left">
                    <h3>Reported User:</h3>
                    <div class="cluster">
                        <a href="../../profile?id=<?php echo $reported->getID(); ?>" target="_blank"><h2><?php echo $reported->getFName(); ?> <?php echo $reported->getLName(); ?></h2></a>
                    </div>
                    <div class="cluster">
                        <a href="./?action=delete-user&id=<?php echo $reported->getID(); ?>" class="btn deletebtn">Delete Profile</a>
                    </div>
                </div>
                <div class="cluster-right">
                    <h3>Reported By:</h3>
                    <div class="cluster">
                        <a href="../../profile?id=<?php echo $reporter->getID(); ?>" target="_blank"><h2><?php echo $reporter->getFName(); ?> <?php echo $reporter->getLName(); ?></h2></a>
                    </div>
                    <div class="cluster">
                        <a href="./?action=delete-user&id=<?php echo $reporter->getID(); ?>" class="btn deletebtn right">Delete Profile</a>
                    </div>
                </div>

                <div id="feed-content">

                    <div id="head" class="clearfix">
                        
                        <div id="proj-thumb">
                            <img src="../../images/<?php echo $project->getProjThumb(); ?>" />
                        </div>

                        <div id="proj-details">
                            <h2><?php echo $project->getProjTitle(); ?></h2>
                            <p><?php echo $project->getProjDesc(); ?></p>
                        </div>

                    </div>

                    <div id="content" class="clearfix">

                        
                        

                    </div>

                    <div id="comments" class="clearfix">

                        
                        

                    </div>

                </div><!-- END feed-content -->

                <div class="cluster-center">
                    <a href="./?action=delete-project&id=<?php echo $project->getID(); ?>" class="btn deletebtn nofloat projectwidth">Delete Project</a>
                </div>

            </div>

        </div><!-- END main-admin -->

    </section><!-- END main section -->

<?php include '../view/footer.php'; ?>