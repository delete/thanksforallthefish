<?php 
/**
* All field classe must extends this class.
*/
abstract class Field
{
    /**
    * @var string
    */
    protected $name;
    /**
    * @var integer
    */
    protected $max_length;
    /**
    * @var boolean
    */
    protected $canBeNull;
    /**
    * @var boolean
    */
    protected $primary_key;
    /**
    * @var string
    */
    protected $valueType;
    /**
    * @var string
    */
    protected $fieldType;
    /**
    * @var string
    */
    protected $className;
    /**
    * @var integer
    */
    public $value;
    protected $default;
    

    function __construct($name, $max_length, $canBeNull, $primary_key, $default, $type)
    {
        $this->name = $name;
        $this->max_length = $max_length;
        $this->canBeNull = $canBeNull;
        $this->primary_key = $primary_key;
        $this->default = $default;
        $this->type = $type;
        $this->value = $this->default;
    }
    
    public function getValueType()
    {
        return $this->valueType;
    }

    public function getFieldType()
    {
        return $this->fieldType;
    }
  
    /**
    * @return boolean validated?
    * @throws Exception
    */
    abstract protected function validate();
    /**
    * @return string sql_query
    * @throws Exception
    */
    abstract protected function create();
    
    /**
    * @throws Exception
    */
    protected function validateName()
    {
        if (empty($this->name) || !is_string($this->name)) {
            throw new Exception($this->className . ' must have a name!');
        }
    }
    
    /**
    * @throws Exception
    */
    protected function validateMaxLength()
    {
        if ($this->max_length < 1) {
            throw new Exception('max_length must be greater or equal to one!');
        }
    }

    /**
    * @param Field $field
    * @param string $name
    * @throws Exception
    */
    protected function validateBool($field, $name)
    {
        if ( !is_bool($field) or is_null($field) ) {
            throw new Exception($name . ' must be boolean (true or false)!');
        } 
    }

    /**
    * @param boolean $field
    * @return integer
    */
    protected function convertBoolToInt($field_value)
    {
        return $field_value = $field_value ? 1 : 0;
    }

    /**
    * @return string
    */
    protected function createName()
    {
        return "`" . $this->name . "`";
    }
    /**
    * @return string
    */
    protected function createType()
    {
        return $this->type . "(" . $this->max_length .")";
    }
    /**
    * @return string
    */
    protected function createCanBeNull()
    {
        if (!$this->canBeNull) {
            return "NOT NULL";
        }
        return "";
    }
    /**
    * @return string
    */
    protected function createPrimaryKey()
    {
        if ($this->primary_key) {
            return "PRIMARY_KEY";
        }
        return "";
    }
    /**
    * @return string
    */
    protected function createDefault()
    {
        return "DEFAULT " . $this->default;
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