<?php

function autoload($class){
    $file = __DIR__ . '/' . $class . '.php';
    if(file_exists($file)) {
       include $file;
    }
}
spl_autoload_register("autoload");