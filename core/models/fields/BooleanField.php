<?php 

require_once "Field.php";

class BooleanField extends Field
{  
    public function __construct($name, $default)
    {
        $this->fieldType = 'tinyint';
        $this->valueType= 'boolean';
        $this->className = 'BooleanField';
        
        $this->max_length = 1;
        $this->canBeNull = false;
        $this->primary_key = false;

        parent::__construct($name, $this->max_length, $this->canBeNull, $this->primary_key, $default, $this->fieldType);
    }

    public function validate()
    {
        $this->validateName();
        $this->validateBool($this->default, 'default');
        
        // change bool to int, because defautl field is tinyint.
        $this->default = $this->convertBoolToInt($this->default);

        return true;
    }
    
    public function create()
    {
        $this->validate();
        $name = $this->createName() . " ";
        $type = $this->createType() . " ";
        $null = $this->createCanBeNull() . " ";
        $default = $this->createDefault();

        return  $name . $type . $null . $default . ",";
    }
}