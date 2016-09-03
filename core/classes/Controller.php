<?php 

abstract class Controller
{
    function __construct( $view=null )
    {
        $this->view = $view ? $view : new View();
    }
}