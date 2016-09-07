<?php

$GLOBALS["config"] = [
    "path" => [
        "core" => "/site/core/",
        "modules" => "/site/modules/",
        "vendors" => "/site/core/vendors/",
    ],
    "routes" => [
        "site" => "SiteController",
    ],
    "defaults" => [
        "controller" => "SiteController",
        "method" => "index"
    ],
];