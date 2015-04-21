<?php
  
    require_once '../model/database.php';
    require_once '../model/user.php';
    require_once '../model/userDB.php';
    require_once '../model/project.php';
    require_once '../model/projectDB.php';
    
    if(isset($_GET['search-query'])) {
        $searchQuery = $_GET['search-query'];
        $users = userDB::getUsersForSearch($searchQuery);
        $projects = ProjectDB::getProjectsForSearch($searchQuery);
    }
    require_once 'search.php';
    
?>
