<?php 
use PHPUnit\Framework\TestCase;

require_once "/var/www/futura/common/models/fields/IntegerField.php";

class IntegerFieldTest extends TestCase
{
    protected function setUp() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $this->integerField = new IntegerField("id", 11, false, true, 1);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf( IntegerField::class, $this->integerField );
    }

    public function testIfAttributesExists()
    {
        $this->assertObjectHasAttribute( "name", $this->integerField );
        $this->assertObjectHasAttribute( "max_length", $this->integerField );
        $this->assertObjectHasAttribute( "canBeNull", $this->integerField );
        $this->assertObjectHasAttribute( "primary_key", $this->integerField );
        $this->assertObjectHasAttribute( "default", $this->integerField );
        $this->assertObjectHasAttribute( "valueType", $this->integerField );
        $this->assertObjectHasAttribute( "fieldType", $this->integerField );
        $this->assertObjectHasAttribute( "value", $this->integerField );
    }

    public function testValidate()
    {
        $expected = $this->integerField->validate();

        $this->assertTrue($expected);
    }

    // public function testCreate()
    // {
    //     $expected = "`id` int(11) NOT NULL PRIMARY_KEY DEFAULT 1,";
    //     $actual = $this->integerField->create();
    //     $this->assertEquals($expected, $actual);
    // }

    public function testTypes()
    {
        $expected = 'integer';
        $actual = $this->integerField->getValueType();
        $this->assertEquals($expected, $actual);

        $expected = 'int';
        $actual = $this->integerField->getFieldType();
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