<?php
use PHPUnit\Framework\TestCase;

include "/var/www/futura/common/models/Fields.php";

class IntegerFieldInstancedTest extends TestCase
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

    public function testAttributes()
    {
        $this->assertObjectHasAttribute( "name", $this->integerField );
        $this->assertObjectHasAttribute( "max_length", $this->integerField );
        $this->assertObjectHasAttribute( "canBeNull", $this->integerField );
        $this->assertObjectHasAttribute( "primary_key", $this->integerField );
        $this->assertObjectHasAttribute( "default", $this->integerField );
        $this->assertObjectHasAttribute( "type", $this->integerField );
    }

    public function testValidate()
    {
        $expected = $this->integerField->validate();

        $this->assertTrue($expected);
    }

    public function testCreate()
    {
        $expected = "`id` int(11) NOT NULL PRIMARY_KEY DEFAULT 1,";
        $actual = $this->integerField->create();
        $this->assertEquals($expected, $actual);
    }
}


class IntegerFieldExceptionsTest extends TestCase
{
    /**
     * @expectedException Exception
     * @expectedExceptionMessage IntegerField must have a name!
     */
    public function testNameException() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("", 1, false, true, 1);
        $integerField->validate(); 
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage max_length must be greater or equal to one!
     */
    public function testMaxLengthException() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 0, false, true, 1);
        $integerField->validate(); 
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage If canBeNull is false, IntegerField must have a default value!
     */
    public function testCanBeNullException()
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 11, false, true, null);
        $integerField->validate(); 
    }
    
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage primary_key must be boolean (true or false)!
     */
    public function testPrimaryKeyException() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 1, false, null, 1);
        $integerField->validate(); 
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage IntegerField default must be an int value!
     */
    public function testDefaultException() 
    {
        // name, max_length, canBeNNull, primary_key, default
        $integerField = new IntegerField("id", 1, false, true, "a");
        $integerField->validate();
    }
}