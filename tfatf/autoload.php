<?php 

define( "TFATF_DIR", __DIR__ . "/");

define( "CONTROLLER", TFATF_DIR . "controller/" );
define( "VIEW", TFATF_DIR . "view/" );
define( "ROUTE", TFATF_DIR . "route/" );
define( "CONFIGS", TFATF_DIR . "configs/" );

spl_autoload_register(function ($class) {    

    if( file_exists( CONTROLLER . "{$class}.php") ) {
        require_once CONTROLLER. "{$class}.php";
    } 
    else if( file_exists(VIEW . "{$class}.php") ){
        require_once VIEW . "{$class}.php";
    } 
    else if( file_exists( ROUTE . "{$class}.php") ){
        require_once ROUTE . "{$class}.php";
    } 
    else if( file_exists( CONFIGS . "{$class}.php") ){
        require_once CONFIGS . "{$class}.php";
    }
});