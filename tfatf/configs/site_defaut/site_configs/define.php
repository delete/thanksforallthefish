<?php
    /*
    Define PATHS and CONSTANTS
    - load PATHs
    - load URLs
    */
    
    /* Common paths */
    define( "PATH_SITE", PATH_ROOT );
    define( "PATH_HELPERS", PATH_SITE . "helpers/" );
    
    // Vendors paths
    define( "PATH_VENDORS", PATH_SITE . "vendors/" );
    define( "PATH_SMARTY", PATH_VENDORS . "smarty/" );

    /* Modules paths */
    define( "PATH_MODULES", PATH_SITE . "modules/" );

    /* Public path */
    define( "PATH_PUBLIC", PATH_SITE . "public/" );

    /* Config path */
    define( "PATH_CONFIG", PATH_SITE . "configs/" );
    // Path to json config file, where should be declared all sensitive constants
    define( "PATH_CONFIG_FILE", PATH_CONFIG . "env.json");
       
    /* Public URLs */
    define( "URI_PUBLIC" , "http://" . $_SERVER["HTTP_HOST"] . "/" );
    define( "REQUEST_URI" , "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] );
    define( "URI_CSS" , URI_PUBLIC . "css/" );
    define( "URI_JS" , URI_PUBLIC . "js/" );
    define( "URI_IMAGES" , URI_PUBLIC . "images/" );
    define( "URI_FILES" , URI_PUBLIC . "files/" );