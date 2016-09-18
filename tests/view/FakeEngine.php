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

    function fetch( $data )
    {
        // Retrieve required template
        $template = file_get_contents($data);

        // Replace the context on template
        foreach ($this->context as $key => $value) {
            $template = str_replace("{\$" . $key . "}", $value, $template);
        }

        return $template;
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