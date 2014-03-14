<?php

use Raahul\SchemaExtractor\Column\Mysql;

class MysqlTest extends PHPUnit_Framework_TestCase
{
    private $columns = null;

    public function testColumnName()
    {
        $column = new Mysql($this->getColumn(0));

        $this->assertEquals('id', $column->name);
    }

    public function testColumnType()
    {
        $column = new Mysql($this->getColumn(0));

        $this->assertEquals('int', $column->type);
    }

    public function testIntegerColumnParameter()
    {
        $column = new Mysql($this->getColumn(0));

        $this->assertEquals(array(10), $column->parameters);
    }

    public function testDecimalColumnParameter()
    {
        $column = new Mysql($this->getColumn(1));

        $this->assertEquals(array(10, 20), $column->parameters);
    }

    public function testVarcharColumnParameter()
    {
        $column = new Mysql($this->getColumn(2));

        $this->assertEquals(array(100), $column->parameters);
    }

    public function testEnumColumnParameters()
    {
        $column = new Mysql($this->getColumn(3));

        $this->assertEquals(array('admin', 'moderator', 'user'), $column->parameters);
    }

    public function testColumnIsNull()
    {
        $column = new Mysql($this->getColumn(2));

        $this->assertEquals(true, $column->null);
    }

    public function testColumnIsNotNull()
    {
        $column = new Mysql($this->getColumn(1));

        $this->assertEquals(false, $column->null);
    }

    public function testColumnIsUnsigned()
    {
        $column = new Mysql($this->getColumn(0));

        $this->assertEquals(true, $column->unsigned);
    }

    public function testColumnIsNotUnsigned()
    {
        $column = new Mysql($this->getColumn(1));

        $this->assertEquals(false, $column->unsigned);
    }

    public function testColumnHasDefaultValue()
    {
        $column = new Mysql($this->getColumn(2));

        $this->assertEquals('Hello', $column->defaultValue);
    }

    public function testColumnDoesNotHaveDefaultValue()
    {
        $column = new Mysql($this->getColumn(1));

        $this->assertEquals(null, $column->defaultValue);
    }

    public function testColumnPrimaryKeyIndex()
    {
        $column = new Mysql($this->getColumn(0));

        $this->assertEquals('primary', $column->index);
    }

    public function testColumnUniqueIndex()
    {
        $column = new Mysql($this->getColumn(1));

        $this->assertEquals('unique', $column->index);
    }

    public function testColumnMultiColumnIndex()
    {
        $column = new Mysql($this->getColumn(2));

        $this->assertEquals('multicolumn', $column->index);
    }

    public function testColumnHasNoIndex()
    {
        $column = new Mysql($this->getColumn(3));

        $this->assertEquals(false, $column->index);
    }

    public function testAutoIncrement()
    {
        $column = new Mysql($this->getColumn(0));

        $this->assertEquals(true, $column->autoIncrement);
    }

    private function getColumn($i)
    {
        if (is_null($this->columns))
        {
            $this->columns = array(
                0 => $this->toObject( array('Field' => 'id', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => 'NULL', 'Extra' => 'auto_increment') ),
                1 => $this->toObject( array('Field' => 'rating', 'Type' => 'decimal(10, 20)', 'Null' => 'NO', 'Key' => 'UNI', 'Default' => 'NULL', 'Extra' => '') ),
                2 => $this->toObject( array('Field' => 'name', 'Type' => 'varchar(100)', 'Null' => 'YES', 'Key' => 'MUL', 'Default' => 'Hello', 'Extra' => '') ),
                3 => $this->toObject( array('Field' => 'type', 'Type' => "enum('admin', 'moderator', 'user')", 'Null' => 'NO', 'Key' => '', 'Default' => 'NULL', 'Extra' => '' ))
            );
        }

        return $this->columns[$i];
    }

    private function toObject($array)
    {
        return (object) $array;
    }
}