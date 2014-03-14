<?php namespace Raahul\SchemaExtractor;

use Raahul\SchemaExtractor\Column\Mysql;

class ColumnFactory
{
    /**
     * Get the appropriate instance of the Column driver for parsing columns
     * @param  string $type   Mysql for now, will add other drivers later
     * @param  array  $column A column from SQL's DESCRIBE
     * @return Column         An instance of a subclass of Column
     */
    public static function getInstance($type, $column)
    {
        switch ($type)
        {
            case "mysql":
                return new Mysql($column);
                break;

            default:
                raise \Exception("Invalid driver type specified for Column instance");
        }
    }
}