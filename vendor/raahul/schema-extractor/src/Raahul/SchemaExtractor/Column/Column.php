<?php namespace Raahul\SchemaExtractor\Column;

class Column
{
    /**
     * The column details array as returned by PDO's DESCRIBE table, but
     * just for one column
     * @var array
     */
    protected $column;

    /**
     * The name of the column
     * @var string
     */
    public $name;

    /**
     * The type of the column
     * @var string
     */
    public $type;

    /**
     * Parameters to the column
     * @var array
     */
    public $parameters;

    /**
     * The default value of the column
     * @var string
     */
    public $defaultValue;

    /**
     * Is the column unsigned
     * @var bool
     */
    public $unsigned;

    /**
     * Is the column nullable
     * @var bool
     */
    public $null;

    /**
     * Which type of index does the column have
     * @var string|false
     */
    public $index;

    /**
     * Is the column auto-incrementing
     * @var bool
     */
    public $autoIncrement;


    /**
     * Initialize the column array and begin parsing
     * @param array $column A single column out of SQL's DESCRIBE
     */
    public function __construct($column)
    {
        $this->column = $column;
        $this->parse();
    }


    /**
     * Parses the column data and generates meta data in the form of instance
     * variables described above. Has to be overriden in the child class.
     *
     * @return void
     */
    protected function parse() {}
}