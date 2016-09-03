<?php 
use PHPUnit\Framework\TestCase;

require_once "/var/www/site/core/models/fields/BooleanField.php";

class BooleanFieldTest extends TestCase
{
    protected function setUp() 
    {
        // name, default
        $this->booleanField = new BooleanField("status", true);
    }

    public function testInstanceType()
    {
        $this->assertInstanceOf( BooleanField::class, $this->booleanField );
    }

    public function testIfAttributesExists()
    {
        $attributes = [
            'name', 'max_length', 'canBeNull', 'primary_key', 'default',
            'valueType', 'fieldType', 'className', 'value'
        ];

        foreach ($attributes as $attr) {
            $this->assertObjectHasAttribute( $attr, $this->booleanField );
        }
    }

    public function testValidate()
    {
        $expected = $this->booleanField->validate();

        $this->assertTrue($expected);
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
    /*
    * Initial value will must be the default value.
    */
    public function testInitialValue()
    {
        $this->assertEquals(true, $this->booleanField->value);
    }

    public function testIfHasMethods()
    {
        $methods = ['create', 'validate'];
        
        foreach ($methods as $method) {
            $this->assertTrue( method_exists($this->booleanField, $method) );
        }
    }
}

class BooleanCreateFunctionTest extends TestCase
{
    /*
    * If name is testing must return "`testing`".
    */
    public function testCreateName()
    {
         // name, default
        $booleanField = new BooleanField("testing", true);

        $expected = "`testing` tinyint(1) NOT NULL DEFAULT 1,";
        $actual = $booleanField->create();
        $this->assertEquals($expected, $actual);
    }
    /*
    * If defaut is false must return "DEFAULT 0".
    */
    public function testCreateDefaultFalse()
    {
         // name, default
        $booleanField = new BooleanField("testing", false);

        $expected = "`testing` tinyint(1) NOT NULL DEFAULT 0,";
        $actual = $booleanField->create();
        $this->assertEquals($expected, $actual);
    }
    /*
    * If defaut is true must return "DEFAULT 1".
    */
    public function testCreateDefaultTrue()
    {
         // name, default
        $booleanField = new BooleanField("testing", true);

        $expected = "`testing` tinyint(1) NOT NULL DEFAULT 1,";
        $actual = $booleanField->create();
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