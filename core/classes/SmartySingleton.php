<?php 

class SmartySingleton
{
    static private $instance;
    
    private function __construct() {}
    
    private function __clone() {}
    
    private function __wakeup() {}
    
    static public function instance()
    {
        if( !isset( self::$instance ) ){
            $smarty = new Smarty;
            
            $smarty->setCompileDir( PATH_SMARTY . '/templates_c/' );
            
            self::$instance = $smarty;
        };
        return self::$instance;
    }
}