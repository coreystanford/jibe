<?php include '../view/header.php'; ?>
<div class="search-slim">
    <div id="search-main">

        <div id="search-box">
            <form method="GET">
                <label>Search</label>
                <input type="text" name="search-query" id="search-query">
                <br/><br/>
                <label>Filter: </label>
                <select name="search-filter" id="search-filter">
                    <option value="all">All</option>
                    <option value="users">Users</option>
                    <option value="projects">Projects</option>
                </select>
                <br/><br/>
                <input type="submit" name="search-btn" id="search-btn">
            </form>
        </div>
        
        <div id="search-results">
            <?php
                
            ?>
            <div id="user-results">
                <?php
                    if(isset($users) && !empty($users)) {
                        echo '<h2>User Results</h2>';
                        echo '<ul>';
                        foreach ($users as $user) {
                            //echo '<li><a href="../profile/?id='.$user->getID().'">'. $user->getFName() . ' ' . $user->getLName() . '</a></li>';
                            echo '<li><a href="../profile/?id='.$user->getID().'" title="'.$user->getFName().' '.$user->getLName().'"><img src="../images_upload/profiles/'.$user->getImgURL().'"</a></li>';
                        }
                        echo '</ul>';
                    }
                ?>
            </div>
            <div id="project-results">
                <?php
                    if(isset($projects) && !empty($projects)) {
                        echo '<h2>Project Results</h2>';
                        echo '<ul>';
                        foreach ($projects as $project) {
                            echo '<li class="project"><a href="#modal" class="open-modal" rel="'.$project->getID().'" title="'.$project->getProjDesc().'"><img src="../Images/'.$project->getProjThumb().'" /></a></li>';
                        }
                        echo '</ul>';
                    }
                ?>
            </div>
        </div>
        
    </div>

</div>

<div id="modal"></div>

<?php include '../view/footer.php'; ?>

<script>
    feedModal.initialize();
</script>