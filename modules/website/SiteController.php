<?php 
/**
* 
*/
class SiteController extends Controller
{    
    public $view;
    public $templateDir;
    
    function __construct($view=null) {
        parent::__construct($view);

        $this->templateDir = dirname(__FILE__) . "/templates/";
    }

    public function index($value=null)
    {
        var_dump($_POST);
        var_dump($_GET);

        $context = ["value" => $value];
        $template = 'index';
        $this->view->load($this->templateDir . $template, $context);
    }
}