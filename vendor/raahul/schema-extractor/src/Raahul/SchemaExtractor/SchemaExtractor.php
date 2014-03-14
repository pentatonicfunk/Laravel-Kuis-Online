<?php namespace Raahul\SchemaExtractor;

class SchemaExtractor
{
    /**
     * Return an array of Column objects with descriptions of each column
     * @param  array  $descriptions An array of columns on which DESCRIBE has been run with PDO::FETCH_OBJ
     * @param  string $type         The type of the database
     * @return array                An array of column objects
     */
    public function extract($descriptions, $type = 'mysql')
    {
        if (!in_array( $type, array('mysql') ))
        {
            throw new \Exception('Invalid database type selected: ' . $type);
        }

        $columns = array();

        foreach ($descriptions as $d)
        {
            $columns[] = ColumnFactory::getInstance($type, $d);
        }

        return $columns;
    }
}