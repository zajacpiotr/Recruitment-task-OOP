<?php
include_once 'DbConfig.php';

class Validation extends DBConfig
{
    public function __construct()
    {
        parent::__construct();
    }
    public function check_empty($data, $fields) 
    {
        $msg= null;
        foreach ($fields as $value) {
            if (empty($data[$value])) {
                $msg .= "$value field empty <br />";
            }
        }
        return $msg;
    }
    public function is_valid($field)
    {
        if (preg_match("/^[a-zA-Z ]*$/", $field)) {    
            return true;
        } 
        return false;
    }
    public function escape_string($value)
    {
        return $this->connection->real_escape_string($value);
    }
    public function select($name, $lastName) 
    { 
        $query = "SELECT id FROM persons WHERE first_name = $name AND last_name= $lastName";
        
        $result = $this->connection->query($query);
    
        if ($result == false) {
            echo 'Error: cannot find id from table persons' ;
            return false;
        } else {
            return true;
        }
    }
}

?>
