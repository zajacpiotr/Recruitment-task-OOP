<?php

include_once("Class/validation.php");
 

$validation = new Validation();
 
   
    $name = $validation->escape_string($_POST['name']);
    $lastName = $validation->escape_string($_POST['lastName']);
    
        
    $msg = $validation->check_empty($_POST, array('name', 'lastName'));
    $check_name = $validation->is_valid($_POST['name']);
    $check_lastName = $validation->is_valid($_POST['lastName']);
    
    // checking empty fields
    if($msg != null) {
        echo $msg;        
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Wróć</a>";
    } elseif (!$check_name) {
        echo 'Podaj prawidłowe imię.';
    } elseif (!$check_lastName) {
        echo 'Podaj prawidłowe nazwisko.';
    }    
    else { 
        $query = "SELECT * FROM persons WHERE first_name = '$name' AND last_name= '$lastName'";
        $result = $validation->getData($query);
       if (count($result)>0) {
           $error= 'Taki sprzedawca znajduje się juz w bazie';
           echo $error;
       }
        if(empty($error)) {
            $result = $validation->execute("INSERT INTO persons (first_name, last_name) VALUES('$name','$lastName')");
        }
       }

    

    
    

?>
