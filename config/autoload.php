<?php 
require_once "globals.php";

spl_autoload_register(function ($class) {
    $corePath = $GLOBALS["config"]["path"]["core"];
    $modulesPath = $GLOBALS["config"]["path"]["modules"];
    $vendorsPath = $GLOBALS["config"]["path"]["vendors"];

    if( file_exists("{$corePath}classes/{$class}.php") ) {
        require_once "{$corePath}/classes/{$class}.php";
    } else if( file_exists("{$corePath}models/{$class}.php") ){
        require_once "{$corePath}/models/{$class}.php";
    } else if( file_exists("{$corePath}helpers/{$class}.php") ){
        require_once "{$corePath}/helpers/{$class}.php";
    } else if( file_exists("{$modulesPath}website/{$class}.php") ){
        require_once "{$modulesPath}/website/{$class}.php";
    } else if( file_exists("{$vendorsPath}smarty/{$class}.class.php") ){
        require_once "{$vendorsPath}/smarty/{$class}.class.php";
    }
});