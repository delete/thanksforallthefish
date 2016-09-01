<?php

$GLOBALS["config"] = [
    "path" => [
        "core" => "/var/www/site/core/",
        "modules" => "/var/www/site/modules/",
        "vendors" => "/var/www/site/core/vendors/",
    ],
    "routes" => [
        "site" => "SiteController",
    ],
    "defaults" => [
        "controller" => "SiteController",
        "method" => "index"
    ],
];