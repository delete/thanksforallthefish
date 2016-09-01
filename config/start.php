<?php
    /*
    Initiate and set things.
    - classes
    - includes
    */

    // Start the session
    session_start();
    
    // Setting up the time
    date_default_timezone_set("America/Sao_Paulo");
    
    /* Includes */
    // Debug is TRUE? Will show erros
    require_once "debug.php";
    showErrorIfDebugMode(PATH_CONFIG_FILE);
    // Paths definitions
    require_once "define.php";
    
    // Load all classes at the same time
    require_once "autoload.php";

    /* SMARTY DEFINITIONS */
    $smarty = SmartySingleton::instance();
    // Public URis
    $smarty->assign( "URI_PUBLIC", URI_PUBLIC );
    $smarty->assign( "URI_CSS", URI_CSS );
    $smarty->assign( "URI_JS", URI_JS );
    $smarty->assign( "URI_IMAGES", URI_IMAGES );
    
    // -- path privados -- //
    $smarty->assign( "PATH_MODULES", PATH_MODULES );
    
    // --- vars --- //
    // $smarty->assign( "script", SCRIPT_NAME );
    $smarty->assign( "REQUEST_URI", REQUEST_URI );
    
    //  Dates
    $smarty->assign( "year", date("Y") );
    $date = new DateTime('now');
    $date->modify('last day of this month');
    $smarty->assign( "lastDayMonth", $date->format('Y-m-d') );
    
    // Months
    $smarty->assign( 
        "month", array( 
            "01" => "Janeiro", 
            "02" => "Fevereiro", 
            "03" => "Março", 
            "04" => "Abril", 
            "06" => "Maio", 
            "06" => "Junho", 
            "08" => "Julho", 
            "08" => "Agosto", 
            "09" => "Setembro", 
            "10" => "Outubro", 
            "11" => "Novembro", 
            "12" => "Dezembro" 
        ) 
    );