<?php 
/**
* All field classe must extends this class.
*/
abstract class Field
{
    private $name;
    private $max_length;
    private $canBeNull;
    private $primary_key;
    private $default;
    private $type;
    
    function __construct($name, $max_length, $canBeNull, $primary_key, $default, $type)
    {
        $this->name = $name;
        $this->max_length = $max_length;
        $this->canBeNull = $canBeNull;
        $this->primary_key = $primary_key;
        $this->default = $default;
        $this->type = $type;
    }

    abstract protected function validate();
}


class IntegerField extends Field
{
    private $name;
    private $max_length;
    private $canBeNull;
    private $primary_key;
    private $default;
    private $type;
    
    public function __construct($name, $max_length, $canBeNull, $primary_key, $default)
    {
        $this->type = 'int';
        
        $this->name = $name ? $name : null;
        $this->max_length = $max_length ? $max_length : null;
        $this->canBeNull = $canBeNull ? $canBeNull : false;
        $this->primary_key = $primary_key ? $primary_key : false;
        $this->default = $default;

        parent::__construct($this->name, $this->max_length, $this->canBeNull, $this->primary_key, $this->default, $this->type);
    }

    public function validate()
    {
        if (empty($this->name)) {
            throw new Exception('IntegerField must have a name!');
        }
        
        if ($this->max_length < 1) {
            throw new Exception('max_length must be greater or equal to one!');
        }
        
        if (!$this->canBeNull) {
            if ($this->default === null) {
                throw new Exception('If canBeNull is false, IntegerField must have a default value!');
            }
        }

        if (! (bool) $this->primary_key ) {
            throw new Exception('primary_key must be boolean (true or false)!');
        }

        if ( !is_int($this->default) ) {
            throw new Exception('IntegerField default must be an int value!');
        }

        return true;
    }
}

/*
verbose_name=None, name=None, primary_key=False,
                 max_length=None, unique=False, blank=False, null=False,
                 db_index=False, rel=None, default=NOT_PROVIDED, editable=True,
                 serialize=True, unique_for_date=None, unique_for_month=None,
                 unique_for_year=None, choices=None, help_text='', db_column=None,
                 db_tablespace=None, auto_created=False, validators=[],
                 error_messages=None
                 http://php.net/manual/pt_BR/function.get-class-vars.php
                 https://github.com/django/django/blob/master/django/db/models/fields/__init__.py
                 https://github.com/delete/estofadora/blob/master/estofadora/client/models.py
                 https://github.com/sebastianbergmann/money/blob/master/tests/CurrencyTest.php
                 https://phpunit.de/manual/current/en/fixtures.html#fixtures.more-setup-than-teardown
`admin_id` int(11) NOT NULL AUTO_INCREMENT,
*/