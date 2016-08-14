<?php 
function showErrorIfDebugMode($configFile)
{
    $json = file_get_contents($configFile);
    $json_object = json_decode($json, true);

    if ( $json_object['debug'] == 'true')
    {
        error_reporting(E_ALL );
        ini_set( "display_errors", 1 );
    }
}
?>
