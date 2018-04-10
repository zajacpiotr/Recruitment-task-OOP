<?php

include_once("Class/validation.php");
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
$validation = new Validation();
 
    $name = $validation->escape_string($_POST['name']);
    $lastName = $validation->escape_string($_POST['lastName']);
    
    $msg = $validation->check_empty($_POST, array('name', 'lastName'));
    $check_name = $validation->is_valid($_POST['name']);
    $check_lastName = $validation->is_valid($_POST['lastName']);
    
    if($msg != null) {
        echo $msg; 
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
           //$result = $validation->execute("INSERT INTO persons (first_name, last_name) VALUES('$name','$lastName')");
            $result = $validation->insert($name, $lastName);
        }
       }

}
?>
    <!DOCTYPE html>
    <html lang="pl">

    <head>
        <meta charset="UTF-8">
        <title>Contact Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <style type="text/css">
            .form-group {
                width: 400px;
                margin: 40px auto;
            }

        </style>
    </head>

    <body>
        <form action="add.php" method="post">
            <div class="form-group">
                <p>Wrzuć sprzedawcę do bazy danych.</p>
                <p>
                    <label for="inputName">Imie:<sup>*</sup></label>
                    <input type="text" name="name" class="form-control" id="inputName">
                </p>
                <p>
                    <label for="inputLastName">Nazwisko:<sup>*</sup></label>
                    <input type="text" name="lastName" class="form-control" id="inputLastName">
                </p>
                <input type="submit" value="Add" class="btn btn-primary">
            </div>
        </form>
    </body>

    </html>
