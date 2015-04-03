<?php

require_once '/model/database.php';


session_start();
session_destroy();

header('location:index.php');
?>
