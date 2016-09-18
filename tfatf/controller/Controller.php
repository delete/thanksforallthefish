<?php 

abstract class Controller
{
    public $view;
    public $templateDir;

    function __construct( $view=null )
    {
        $this->view = $view ? $view : new View();

        // Get child class info then the file name
        $class_info = new ReflectionClass($this);
        $child_filename = $class_info->getFileName();
        
        $this->templateDir = dirname( $child_filename ) . "/templates/";
    }

    public function loadTemplate($template, $context)
    {
        $this->view->load($this->templateDir . $template, $context);
    }

    public function loadJson(Array $data)
    {
        echo json_encode($data);
    }
}