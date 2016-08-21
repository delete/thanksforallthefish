<?php 
use PHPUnit\Framework\TestCase;

require_once "/var/www/futura/common/models/fields/BooleanField.php";

class BooleanFieldTest extends TestCase
{
    protected function setUp() 
    {
        // name, default
        $this->booleanField = new BooleanField("status", true);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf( BooleanField::class, $this->booleanField );
    }

    public function testIfAttributesExists()
    {
        $this->assertObjectHasAttribute( "name", $this->booleanField );
        $this->assertObjectHasAttribute( "max_length", $this->booleanField );
        $this->assertObjectHasAttribute( "canBeNull", $this->booleanField );
        $this->assertObjectHasAttribute( "primary_key", $this->booleanField );
        $this->assertObjectHasAttribute( "default", $this->booleanField );
        $this->assertObjectHasAttribute( "valueType", $this->booleanField );
        $this->assertObjectHasAttribute( "fieldType", $this->booleanField );
        $this->assertObjectHasAttribute( "className", $this->booleanField );
    }

    public function testValidate()
    {
        $expected = $this->booleanField->validate();

        $this->assertTrue($expected);
    }

    public function testCreate()
    {
        $expected = "`status` tinyint(1) NOT NULL DEFAULT 1,";
        $actual = $this->booleanField->create();
        $this->assertEquals($expected, $actual);
    }

    public function testTypes()
    {
        $expected = 'boolean';
        $actual = $this->booleanField->getValueType();
        $this->assertEquals($expected, $actual);

        $expected = 'tinyint';
        $actual = $this->booleanField->getFieldType();
        $this->assertEquals($expected, $actual);
    }
}


class BooleanFieldExceptionsTest extends TestCase
{
    /**
     * @expectedException Exception
     * @expectedExceptionMessage BooleanField must have a name!
     */
    public function testNameEmpty() 
    {
        // name, default
        $booleanField = new BooleanField("", true);
        $booleanField->validate(); 
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage BooleanField must have a name!
     */
    public function testNameNull() 
    {
        // name, default
        $booleanField = new BooleanField(null, true);
        $booleanField->validate(); 
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage default must be boolean (true or false)!
     */
    public function testDefaultNumberException() 
    {
        // name, default
        $booleanField = new BooleanField("id", 1);
        $booleanField->validate();
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage default must be boolean (true or false)!
     */
    public function testDefaultStringException() 
    {
        // name, default
        $booleanField = new BooleanField("id", "error");
        $booleanField->validate();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage default must be boolean (true or false)!
     */
    public function testDefaultNullException() 
    {
        // name, default
        $booleanField = new BooleanField("id", null);
        $booleanField->validate();
    }
}