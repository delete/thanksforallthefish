<?php

require_once "Field.php";

class IntegerField extends Field
{
    public function __construct($name, $max_length, $canBeNull, $primary_key, $default)
    {
        $this->fieldType = 'int';
        $this->valueType = 'integer';
        $this->className = 'IntegerField';
        
        $this->name = $name;
        $this->max_length = $max_length;
        $this->canBeNull = $canBeNull;
        $this->primary_key = $primary_key;
        $this->default = $default;

        parent::__construct($this->name, $this->max_length, $this->canBeNull, $this->primary_key, $this->default, $this->fieldType);
    }

    public function validate()
    {
        $this->validateName();
        $this->validateMaxLength();
        $this->validateBool($this->canBeNull, 'canBeNull');
        $this->validateBool($this->primary_key, 'primary_key');

        if (!$this->canBeNull) {
            if ( !is_int($this->default) ) {
                throw new Exception('IntegerField default must be an int value!');
            }  
        }

        return true;
    }

    public function create()
    {
        $this->validate();
        $name = $this->createName() . " ";
        $type = $this->createType() . " ";
        $null = $this->createCanBeNull() ? $this->createCanBeNull() . " " : "";
        $primary = $this->createPrimaryKey() ? $this->createPrimaryKey() . " ": "";
        $default = $this->createDefault();

        return  $name . $type . $null . $primary . $default . ",";
    }
}