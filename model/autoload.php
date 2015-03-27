<?php

function autoload($class){
    $file = __DIR__ . '/' . $class . '.php';
    if(file_exists($file)) {
       include $file;
       //echo $file . "<br/>";
    }
}

spl_autoload_register("autoload");