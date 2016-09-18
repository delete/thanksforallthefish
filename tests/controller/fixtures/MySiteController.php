<?php 
/**
* 
*/
class MySiteController extends Controller
{    
    public $view;
    public $templateDir;
    
    function __construct($view=null) {
        parent::__construct($view);

        $this->templateDir = dirname(__FILE__) . "/";
    }

    public function index($value=null)
    {
        $context = ["value" => $value, 'firstname' => 'Fellipe'];
        $template = 'myTemplate.html';
        
        $this->loadTemplate($template, $context);
    }

    public function citiesApi()
    {
        $data = [
            '11' => 'Sao Paulo', 
            '21' => 'Rio de Janeiro',
            '61' => 'Brasilia'
        ];

        $this->loadJson($data);
    }
}