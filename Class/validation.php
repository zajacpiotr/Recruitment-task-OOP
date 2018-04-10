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
                $msg .= "$value puste <br />";
            }
        }
        return $msg;
    }
    public function is_valid($field)
    {
        if (preg_match("/^[a-zA-Z\s]+/", $field)) {
            if(strlen($field)>2) {
            return true;
            }
        } 
        return false;
    }
    public function escape_string($value)
    {
        return $this->connection->real_escape_string($value);
    }
    public function getData($query)
    {        
        $result = $this->connection->query($query);
        
        if ($result == false) {
            return false;
        } 
        
        $rows = array();
        
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        
        return $rows;
    }
    public function insert($name, $lastName) 
    { 
        $query = "INSERT INTO persons (first_name, last_name) VALUES('$name','$lastName')";
        
        $result = $this->connection->query($query);
    
        if ($result == false) {
            echo 'Error: cannot insert';
            return false;
        } else {
            return true;
        }
    }
}

?>
