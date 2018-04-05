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
        echo 'działa </br>';
        /*$result= $validation->select($name, $lastName);
        echo $result;*/
        $query = "SELECT * FROM persons WHERE first_name = '$name' AND last_name= '$lastName'";
        $result = $validation->getData($query);
       
           
       }
    

    
    

?>
    <html>

    <head>
        <title>Homepage</title>
    </head>

    <body>


        <table width='80%' border=0>

            <tr bgcolor='#CCCCCC'>
                <td>ID</td>
                <td>Name</td>
                <td>Last Name</td>

            </tr>
            <?php 
    foreach ($result as $key => $res) {
    //while($res = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$res['id']."</td>";
        echo "<td>".$res['first_name']."</td>";
        echo "<td>".$res['last_name']."</td>";    
              
    }
    ?>
        </table>
    </body>

    </html>
