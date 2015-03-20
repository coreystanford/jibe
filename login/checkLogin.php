<?php

include '../model/database.php';
   
//Define $username and $password 
$email=$_POST['email']; 
$password=$_POST['password']; 

    $db = database::getDB();
   
    $sql = "SELECT * FROM user_info WHERE email='$email' and password='$password'";
    
    $checkLogin = $db->query($sql);
    
    $row =$checkLogin->fetch();
    
    //var_dump($checkLogin->fetch());
    
   //$row = count($checkLogin->fetchAll);
  
if($row != false) {
    
    $_SESSION['email'] = $row['email'];
    $_SESSION['role'] = $row['role'];
    
    if($row['role'] = 0) {
        
        header('location:../profile/index.php');
    }else{
        
        header('location:../admin/index.php');
    }
    
  
}else{
   header('location:mainLogin.php');
   echo "incorrect e-mail and password";
   
}

