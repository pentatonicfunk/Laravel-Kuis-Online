<?php namespace Raahul\SchemaExtractor\Column;

use Raahul\SchemaExtractor\Column\Column;

class Mysql extends Column
{
    /**
     * Parse all the details of the given column
     */
    protected function parse()
    {
        // Parse the column name
        $this->parseName();

        // Parse the column type
        $this->parseType();

        // Parse column type parameters
        $this->parseParameters();

        // Parse if column is null
        $this->parseNull();

        // Parse if column is unsigned
        $this->parseUnsigned();

        // Parse column default value
        $this->parseDefaultValue();

        // Parse column index
        $this->parseIndex();

        // Parse extra
        $this->parseExtra();
    }


    /**
     * Parse the name of the column
     */
    protected function parseName()
    {
        $this->name = $this->column->Field;
    }


    /**
     * Parse the type of the column without any additional parameters
     */
    protected function parseType()
    {
        // Find everything till the end or the start of the first parenthesis
        preg_match('/(^[^(]+)/', $this->column->Type, $matches);

        // We should have a match, and the type should be in $matches[1]
        $this->type = $matches[1];
    }


    /**
     * Parse the additional parameters to a column, which can be the length, precision,
     * or values in case of enums
     */
    protected function parseParameters()
    {
        // Find everything inside the parentheses
        preg_match('/\((.*)\)/', $this->column->Type, $matches);

        // We may or may not a match in $matches[1]
        if ( !isset($matches[1]) )
        {
            $this->parameters = array();
            return;
        }

        // From now on, we have parameters. Parse them as CSV.
        $params = str_getcsv($matches[1], ',', "'");

        // If the field type is enum, then the paramters are strings, else they are
        // numeric
        if ($this->type != 'enum')
        {
            $params = array_map('intval', $params);
        }

        // Set the parameters
        $this->parameters = $params;
    }


    /**
     * Parse whether the column is null
     */
    protected function parseNull()
    {
        $this->null = ($this->column->Null == 'YES');
    }


    /**
     * Parse whether the column is unsigned
     */
    protected function parseUnsigned()
    {
        // See if unsigned is the last word in the column type
        if (preg_match('/ unsigned$/', $this->column->Type))
        {
            $this->unsigned = true;
        }
        else
        {
            $this->unsigned = false;
        }
    }


    /**
     * Parse the default value of the column, which is null if there is no default
     */
    protected function parseDefaultValue()
    {
        if ($this->column->Default != 'NULL')
        {
            $this->defaultValue = $this->column->Default;
        }
        else
        {
            $this->defaultValue = null;
        }
    }


    /**
     * Parse which index the column has, false if no index present
     */
    protected function parseIndex()
    {
        switch ($this->column->Key)
        {
            case 'PRI':
                $this->index = 'primary';
                break;

            case 'UNI':
                $this->index = 'unique';
                break;

            case 'MUL':
                $this->index = 'multicolumn';
                break;

            default:
                $this->index = false;
        }
    }

    /**
     * Parse extra parameters
     */
    protected function parseExtra()
    {
        if ($this->column->Extra == 'auto_increment')
        {
            $this->autoIncrement = true;
        }
        else
        {
            $this->autoIncrement = false;
        }
    }
}