<?php

/*
 * Author: Wilston Dsouza
 * This files acts as the controller for the
 * search system.
 */

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
