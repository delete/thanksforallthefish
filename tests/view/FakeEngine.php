<?php 
/**
* This class is simple Smarty class fake.
* Do you wnat to test a method from Smarty class? Add to this class.
*/
class FakeEngine
{
    private $context;

    function __construct()
    {
        $this->context = [];
    }

    public function assign($data)
    {
       $this->context = array_merge($this->context , $data);
    }

    function fetch( $templatePath )
    {
        // Retrieve required template
        $templateContent = file_get_contents($templatePath);

        // Replace the context on template
        foreach ($this->context as $key => $value) {
            $templateContent = str_replace("{\$" . $key . "}", $value, $templateContent);
        }

        return $templateContent;
    }

    public function display($template)
    {
        echo $this->fetch($template);
    }

    public function clearAllAssign()
    {
        $this->context = [];
    }
    public function getTemplateVars()
    {
        return array_values($this->context);
    }
}