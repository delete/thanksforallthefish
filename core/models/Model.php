<?php 

abstract class Model
{
    // All models must have this attribute! Sets the table name.
    public $_table_;
    protected $tableQuery;

    // Must pass all the attributos as array to createTable function.
    protected function createTable (array $vars) 
    {
        $_table_ = $this->_table_;

        $newVars = $this->removeCommaFromLast($vars);

        $queries = [];

        foreach ($newVars as $key => $value) {
            foreach ($value as $key => $field) {
                $queries[] = $field;
            }
        }
        $strings = "".implode("\n",$queries);

        $this->tableQuery = "CREATE TABLE `" . $_table_ ."`(\n". $strings  ."\n) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    }

    public function getTableQuery()
    {
        return $this->tableQuery;
    }

    private function removeCommaFromLast($array){
        $lastEl = array_pop($array);
        $k = key($lastEl);
        $lastEl[$k] = trim($lastEl[$k], ',');
        $array[] = $lastEl;
        return $array;
    }
}