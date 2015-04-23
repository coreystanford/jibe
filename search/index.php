<?php
  
    require '../config.php';
    require '../errors/errorhandler.php';
    require '../model/autoload.php';
    
    if (!isset($_SESSION)){
        session_start();
    }

    if(!HomepageDB::isLoggedIn()){
        header("Location: ../");
        die();
    }

    //require_once '../model/database.php';
    //require_once '../model/user.php';
    //require_once '../model/userDB.php';
    //require_once '../model/project.php';
    //require_once '../model/projectDB.php';
    //require_once '../model/category.php';
    //require_once '../model/categoryDB.php';
    
    if(isset($_GET['search-query'])) {
        $searchQuery = $_GET['search-query'];
        $searchFilter = $_GET['search-filter'];
        if($searchFilter == "all" || $searchFilter == "users") {
            $users = userDB::getUsersForSearch($searchQuery);
        }
        if($searchFilter == "all" || $searchFilter == "projects") {
            $projects = ProjectDB::getProjectsForSearch($searchQuery);
            //$projects = ProjectDB::getProjects();
        }
    }
    require_once 'search.php';
    
?>
