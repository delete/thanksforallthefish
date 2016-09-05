<?php
    /*
    Define PATHS and CONSTANTS
    - load PATHs
    - load URLs
    */
    
    # Relative root path, returns 1 path before public
    define( "PATH_ROOT", dirname($_SERVER['DOCUMENT_ROOT']) . "/");

    /* Common paths */
    define( "PATH_SITE", PATH_ROOT );
    define( "PATH_CORE", PATH_SITE . "core/");
    define( "PATH_CLASSES", PATH_CORE . "classes/" );
    define( "PATH_FUNCTIONS", PATH_CORE . "funcs/" );
    define( "PATH_VENDORS", PATH_CORE . "vendors/" );
    // Vendors paths
    define( "PATH_SMARTY", PATH_VENDORS . "smarty/" );

    /* Plugins paths */
    define( "PATH_MODULES", PATH_SITE . "modules/" );

    /* Public path */
    define( "PATH_PUBLIC", PATH_SITE . "public/" );

    /* Config path */
    define( "PATH_CONFIG", PATH_SITE . "config/" );
    // Path to json config file, where should be declared all sensitive constants
    define( "PATH_CONFIG_FILE", PATH_SITE . "config/env.json");
       
    /* Public URLs */
    define( "URI_PUBLIC" , "http://" . $_SERVER["HTTP_HOST"] . "/" );
    define( "REQUEST_URI" , "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] );
    define( "URI_CSS" , URI_PUBLIC . "css/" );
    define( "URI_JS" , URI_PUBLIC . "js/" );
    define( "URI_IMAGES" , URI_PUBLIC . "images/" );
    define( "URI_FILES" , URI_PUBLIC . "files/" );