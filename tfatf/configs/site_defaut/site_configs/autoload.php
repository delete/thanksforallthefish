<?php 

// AUTO LOAD CLASSES
spl_autoload_register(function ($class) {
    $modulesPath = $GLOBALS["config"]["paths"]["modules"];
    $vendorsPath = $GLOBALS["config"]["paths"]["vendors"];

    if( file_exists("{$modulesPath}website/{$class}.php") ){
        require_once "{$modulesPath}/website/{$class}.php";
    } 
    else if( file_exists("{$vendorsPath}smarty/{$class}.class.php") ){
        require_once "{$vendorsPath}/smarty/{$class}.class.php";
    }
});