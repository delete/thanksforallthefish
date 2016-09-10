<?php 

abstract class Controller
{
    public $view;
    public $templateDir;

    function __construct( $view=null )
    {
        $this->view = $view ? $view : new View();
    }
}