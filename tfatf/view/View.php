<?php 
/**
* 
*/
class View
{
    private $engine;

    function __construct($engine=null) {
        # Instantiate Smarty as a default template engine
        $this->engine = $engine ? $engine : SmartySingleton::instance();
    }

    public function load($template, Array $context)
    {
        $this->assign($context);
        $this->engine->display($template);
    }

    public function assign($data)
    {
        $this->engine->assign($data);
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

    public function getTemplateDir($relatedName=null)
    {
        return $this->engine->getTemplateDir($relatedName);
    }

    public function addTemplateDir($dir, $relatedName)
    {
        $this->engine->addTemplateDir($dir, $relatedName);
    } 
}