<?php 
use PHPUnit\Framework\TestCase;

require_once "/var/www/site/common/models/fields/IntegerField.php";

class IntegerFieldTest extends TestCase
{
    protected function setUp() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $this->integerField = new IntegerField("id", 11, false, true, 1);
    }

    public function testInstanceType()
    {
        $this->assertInstanceOf( IntegerField::class, $this->integerField );
    }

    public function testIfAttributesExists()
    {
        $attributes = [
            'name', 'max_length', 'canBeNull', 'primary_key', 'default',
            'valueType', 'fieldType', 'className', 'value'
        ];

        foreach ($attributes as $attr) {
            $this->assertObjectHasAttribute( $attr, $this->integerField );
        }
    }

    public function testValidate()
    {
        $expected = $this->integerField->validate();

        $this->assertTrue($expected);
    }

    public function testTypes()
    {
        $expected = 'integer';
        $actual = $this->integerField->getValueType();
        $this->assertEquals($expected, $actual);

        $expected = 'int';
        $actual = $this->integerField->getFieldType();
        $this->assertEquals($expected, $actual);
    }
    /*
    * Initial value will must be the default value.
    */
    public function testInitialValue()
    {
        $this->assertEquals(1, $this->integerField->value);
    }
    
    public function testIfHasMethods()
    {
        $methods = ['create', 'validate'];
        
        foreach ($methods as $value) {
            $this->assertTrue( method_exists($this->integerField, $value) );
        }
    }
}

class IntegerFieldCreateFunctionTest extends TestCase
{
    /*
    * If name is testing must return "`testing`".
    */
    public function testCreateName()
    {
         // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("testing", 11, true, true, 1);

        $expected = "`testing` int(11) PRIMARY_KEY DEFAULT 1,";
        $actual = $integerField->create();
        $this->assertEquals($expected, $actual);
    }
    /*
    * If cabBeNull is true must not return "NOT NULL".
    */
    public function testCreateNull()
    {
         // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 11, true, true, 1);

        $expected = "`id` int(11) PRIMARY_KEY DEFAULT 1,";
        $actual = $integerField->create();
        $this->assertEquals($expected, $actual);
    }
    /*
    * If cabBeNull is false must return "NOT NULL".
    */
    public function testCreateNotNull()
    {
         // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 11, false, true, 1);

        $expected = "`id` int(11) NOT NULL PRIMARY_KEY DEFAULT 1,";
        $actual = $integerField->create();
        $this->assertEquals($expected, $actual);
    }
    /*
    * If cabBeNull is true must not return "NOT NULL".
    * If primary_key is true must return "PRIMARY_KEY".
    */
    public function testCreatePrimaryKey()
    {
         // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 11, true, true, 1);

        $expected = "`id` int(11) PRIMARY_KEY DEFAULT 1,";
        $actual = $integerField->create();
        $this->assertEquals($expected, $actual);
    }
    /*
    * If cabBeNull is true must not return "NOT NULL".
    * If primary_key is false must not return "PRIMARY_KEY".
    */
    public function testCreateNotPrimaryKey()
    {
         // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 11, true, false, 1);

        $expected = "`id` int(11) DEFAULT 1,";
        $actual = $integerField->create();
        $this->assertEquals($expected, $actual);
    }
    /*
    * If cabBeNull is true must not return "NOT NULL".
    * If primary_key is false must not return "PRIMARY_KEY".
    * If default is 10 must return "DEFAULT 10".
    */
    public function testCreateDefaul10()
    {
         // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 11, true, false, 10);

        $expected = "`id` int(11) DEFAULT 10,";
        $actual = $integerField->create();
        $this->assertEquals($expected, $actual);
    }
}

class IntegerFieldNameExceptionsTest extends TestCase
{
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage IntegerField must have a name!
     */
    public function testNameEmpty() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("", 1, false, true, 1);
        $integerField->validate(); 
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage IntegerField must have a name!
     */
    public function testNameNull() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField(null, 1, false, true, 1);
        $integerField->validate(); 
    }
}


class IntegerFieldMaxLengthExceptionsTest extends TestCase
{
    /**
     * @expectedException Exception
     * @expectedExceptionMessage max_length must be greater or equal to one!
     */
    public function testMaxLengthZero() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 0, false, true, 1);
        $integerField->validate(); 
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage max_length must be greater or equal to one!
     */
    public function testMaxLengthNull() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", null, false, true, 1);
        $integerField->validate(); 
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage max_length must be greater or equal to one!
     */
    public function testMaxLengthString() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", "error", false, true, 1);
        $integerField->validate(); 
    }
}


class IntegerFieldCanBeNullExceptionsTest extends TestCase
{
    /**
     * @expectedException Exception
     * @expectedExceptionMessage canBeNull must be boolean (true or false)!
     */
    public function testCanBeNullString()
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 11, "error", true, 1);
        $integerField->validate(); 
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage canBeNull must be boolean (true or false)!
     */
    public function testCanBeNullNull()
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 11, null, true, 1);
        $integerField->validate(); 
    }
}


class IntegerFieldPrimaryKeyExceptionsTest extends TestCase
{
    /**
     * @expectedException Exception
     * @expectedExceptionMessage primary_key must be boolean (true or false)!
     */
    public function testPrimaryKeyNull() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 1, false, null, 1);
        $integerField->validate(); 
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage primary_key must be boolean (true or false)!
     */
    public function testPrimaryKeyString() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 1, false, "a", 1);
        $integerField->validate(); 
    }
}


class IntegerFieldDefaultExceptionsTest extends TestCase
{   
    /**
     * @expectedException Exception
     * @expectedExceptionMessage IntegerField default must be an int value!
     */
    public function testDefaultString() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 1, false, true, "a");
        $integerField->validate();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage IntegerField default must be an int value!
     */
    public function testDefaultNull() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 1, false, true, null);
        $integerField->validate();
    }
}