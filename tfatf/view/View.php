<?php 
/**
* 
*/
class View
{
    private $engine;
    private $templateDir;

    function __construct($engine=null) {
        $this->engine = $engine ? $engine : SmartySingleton::instance();
    }

    public function load($template, Array $context)
    {
        $this->engine->assign($context);
        $this->engine->display($template . '.html');
    }

    public function clearAllAssign()
    {
        $this->engine->clearAllAssign();
    }

    public function fetch($data=null){
        return $this->engine->fetch($data);
    }

    public function templateVars()
    {
        return $this->engine->getTemplateVars();
    }    
}