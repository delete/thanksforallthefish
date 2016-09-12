<?php
define( "PATH_ROOT", __DIR__ . "/");


// TFATF will use these variables, make sure to define them!
$GLOBALS["config"] = [
    "paths" => [
        "modules" => PATH_ROOT . "modules/",
        "vendors" => PATH_ROOT . "vendors/",
    ],
    "routes" => [
        "site" => "SiteController",
    ],
    "defaults" => [
        "controller" => "SiteController",
        "method" => "index"
    ],
];


// Autoload all classes from Thanks For All The Fish Micro Web Framework
require_once PATH_ROOT . "tfatf/autoload.php";
// // Autoload all classes from the app
require_once PATH_ROOT . "configs/autoload.php";