<?php 
/**
* 
*/
class FakeView
{
    public function load($template, Array $context)
    {   
        echo file_get_contents($template . '.html');
    }

    public function clearAllAssign()
    {
        return [];
    }

    public function templateVars()
    {
        return ["value" => "fellipe"];
    }    
}