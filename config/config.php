<?php
    /*
    Define PATHS and CONSTANTS
    - load PATHs
    - load URLs
    */
    
    # Relative root path, returns 1 path before public
    define( "PATH_ROOT", dirname($_SERVER['DOCUMENT_ROOT']) . "/");

    /* Common paths */
    define( "PATH_COMMON", PATH_ROOT . "common/")
    define( "PATH_CLASSES", PATH_COMMON . "classes/" );
    define( "PATH_FUNCTIONS", PATH_COMMON . "funcs/" );
    define( "PATH_VENDORS", PATH_COMMON . "vendors/" );
    // Vendors paths
    define( "PATH_SMARTY", PATH_VENDORS . "smarty/" );
    
    /* Templates paths */
    define( "PATH_TEMPLATES", PATH_ROOT . "templates/" );

    /* Plugins paths */
    define( "PATH_PLUGINS", PATH_ROOT . "plugins/" );

    /* Public path */
    define( "PATH_PUBLIC", PATH_ROOT . "public/" );

    /* Config path */
    define( "PATH_CONFIG", PATH_ROOT . "config/" );
    // Path to json config file, where should be declared all sensitive constants
    define( "PATH_CONFIG_FILE", PATH_ROOT . "config/config.json");
       
    /* Public URLs */
    define( "URI_PUBLIC" , "http://" . $_SERVER["HTTP_HOST"] . "/" );
    define( "REQUEST_URI" , "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] );
    define( "URI_CSS" , URI_PUBLIC . "css/" );
    define( "URI_JS" , URI_PUBLIC . "js/" );
    define( "URI_IMAGES" , URI_PUBLIC . "images/" );
    define( "URI_FILES" , URI_PUBLIC . "files/" );
    
?>
