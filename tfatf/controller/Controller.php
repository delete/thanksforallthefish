<?php 

abstract class Controller
{
    public $view;
    public $templateDir;

    function __construct( $view=null )
    {
        $this->view = $view ? $view : new View();

        $this->templateDir = __DIR__ . "/templates/";
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