<?php

include_once("Class/validation.php");
 $name = $lastName = "";
    $nameErr = $lastNameErr = $error = $msg = $errorMsg = $insertMsg = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $validation = new Validation();
 
    $name = $validation->escape_string($_POST['name']);
    $lastName = $validation->escape_string($_POST['lastName']);
    
    $msg = $validation->check_empty($_POST, array('name', 'lastName'));
    $check_name = $validation->is_valid($_POST['name']);
    $check_lastName = $validation->is_valid($_POST['lastName']);
    
    if($msg != null) {
        $errorMsg= $msg; 
    } elseif (!$check_name) {
        $nameErr = 'Podaj prawidłowe imie.';
    } elseif (!$check_lastName) {
        $lastNameErr = 'Podaj prawidłowe nazwisko.';
    }    
    else { 
        $query = "SELECT * FROM persons WHERE first_name = '$name' AND last_name= '$lastName'";
        $result = $validation->getData($query);
       if (count($result)>0) {
           $error= 'Taki sprzedawca znajduje się juz w bazie';
           //echo $error;
       }
        if(empty($error)) {
           //$result = $validation->execute("INSERT INTO persons (first_name, last_name) VALUES('$name','$lastName')");
            $result = $validation->insert($name, $lastName);
            if($result){
                $insertMsg= "Sprzedwca dodany do bazy danych";
            }
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
        <link type="text/css" rel="stylesheet" href="style.css" />
    </head>

    <body>
        <form action="index.php" method="post">
            <div class="form-group">
                <p>Wrzuć sprzedawcę do bazy danych.</p>
                <p>
                    <label for="inputName">Imie:<sup>*</sup></label>
                    <input type="text" name="name" class="form-control" id="inputName" value="<?php echo $name; ?>">
                    <span class="error"><?php echo $nameErr; ?></span>
                </p>
                <p>
                    <label for="inputLastName">Nazwisko:<sup>*</sup></label>
                    <input type="text" name="lastName" class="form-control" id="inputLastName" value="<?php echo $lastName; ?>">
                    <span class="error"><?php echo $lastNameErr; ?></span>
                </p>
                <input type="submit" value="Add" class="btn btn-primary">
                <p class="success">
                    <?php echo $insertMsg?>
                </p>
                <p class="error">
                    <?php echo $error;
                    echo $errorMsg?>
                </p>
            </div>
        </form>
        <?php
        $query = "SELECT * FROM persons";                 
        $result = $validation->getData($query);
        ?>
            <div id="conteiner">
                <div class="row">
                    <div class='cell'>id</div>
                    <div class='cell'>Imie</div>
                    <div class='cell'>Nazwisko</div>
                </div>
                <?php 
    foreach ($result as $key => $res) {         
        echo "<div class='row'>";
        echo "<div class='cell'>".$res['id']."</div>";
        echo "<div class='cell'>".$res['first_name']."</div>";
        echo "<div class='cell'>".$res['last_name']."</div>";  
        echo "</div>";
    }
    ?>
            </div>
    </body>

    </html>
