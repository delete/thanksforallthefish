<?php 
use PHPUnit\Framework\TestCase;

require_once "/var/www/site/common/classes/Item.php";


class ItemTest extends TestCase
{
    protected function setUp() 
    {
        $id = 5;
        $status = true;
        $this->itemModel = new Item($id, $status);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf( Item::class, $this->itemModel );
    }

    public function testIfAttributesExists()
    {
        $this->assertObjectHasAttribute( "_table_", $this->itemModel );
        $this->assertObjectHasAttribute( "id", $this->itemModel );
        $this->assertObjectHasAttribute( "status", $this->itemModel );
    }

    public function testAttributesValues()
    {
        $this->assertEquals('item', $this->itemModel->_table_);
        $this->assertEquals(5, $this->itemModel->id->value);
        $this->assertEquals(true, $this->itemModel->status->value);
    }

    public function testAttributesValuesTypes()
    {
        $this->assertEquals('integer', gettype($this->itemModel->id->value));
        $this->assertEquals('boolean', gettype($this->itemModel->status->value));
    }
}

class ItemCreateTableFunctionTest extends TestCase
{
    
    public function testCreateTable()
    {
        $id = 5;
        $status = true;
        $temModel = new Item($id, $status);

        $tableName = $temModel->getTableQuery();

        $this->assertEquals(
            "CREATE TABLE `item`(\n`id` int(11) NOT NULL PRIMARY_KEY DEFAULT 5,\n`status` tinyint(1) NOT NULL DEFAULT 1\n) ENGINE=InnoDB DEFAULT CHARSET=latin1;", $tableName
        );
    }
}