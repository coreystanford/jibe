<?php include '../view/header.php'; ?>

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
                    echo '<h3>User Results<h3/>';
                    echo '<ul>';
                    foreach ($users as $user) {
                        echo '<li><a href="../profile/?id='.$user->getID().'">'. $user->getFName() . ' ' . $user->getLName() . '</a></li>';
                    }
                    echo '</ul>';
                }
            ?>
        </div>
        <div id="project-results">
            <?php
                if(isset($projects) && !empty($projects)) {
                    echo '<h3>Project Results<h3/>';
                    echo '<ul>';
                    foreach ($projects as $project) {
                        echo '<li><a href="../project/?id='.$project->getID.'">'. $project->getProjTitle() . ' ' . $project->getProjDesc() . '</a></li>';
                    }
                    echo '</ul>';
                }
            ?>
        </div>
    </div>
    
</div>


<?php include '../view/footer.php'; ?>