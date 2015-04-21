<?php include '../view/header.php'; ?>

<div id="search-main">

    <div id="search-box">
        <form method="GET">
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
        
    </div>
    
</div>


<?php include '../view/footer.php'; ?>