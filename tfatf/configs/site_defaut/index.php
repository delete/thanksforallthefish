<?php
    require __DIR__ . "/../settings.php";

    require_once __DIR__ . "/../configs/start.php";
    
    $router = new Router();
    $router->routing();
?>