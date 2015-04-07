<?php

require_once  './model/database.php';
 
   
//Define $username and $password 
$email=$_POST['email']; 
$password=$_POST['password']; 

    $db = database::getDB();
   
    $sql = "SELECT * FROM user_info WHERE email='$email' and password='$password'";
    
    $checkLogin = $db->prepare($sql);
    
    $row =$checkLogin->fetch();
    
    //var_dump($checkLogin->fetch());
    
   //$row = count($checkLogin->fetchAll);
  
if($row != false) {
    
    $_SESSION['email'] = $row['email'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['user_id'] = $row['user_id'];
    
    if($row['role'] = 0) {
        
        header('location:../profile/');
    }else{
        
        header('location:../admin/');
    }
    
  
}else{
   header('location:mainLogin.php');
   echo "incorrect e-mail and password";
   
}

