<html>

<head>
    <title>Add Data</title>
</head>

<body>
    <?php

include_once("classes/validation.php");
 

$validation = new Validation();
 
if(isset($_POST['Submit'])) {    
    $name = $validation->escape_string($_POST['name']);
    $lastName = $validation->escape_string($_POST['lastName']);
    
        
    $msg = $validation->check_empty($_POST, array('name', 'lastName'));
    $check_name = $validation->is_valid($_POST['name']);
    $check_lastName = $validation->is_valid($_POST['lastName']);
    
    // checking empty fields
    if($msg != null) {
        echo $msg;        
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } elseif (!$check_name) {
        echo 'Please provide proper name.';
    } elseif (!$check_lastName) {
        echo 'Please provide proper last name.';
    }    
    else { 
        // if all the fields are filled (not empty) 
            
        //insert data to database    
        echo 'działa'
        
        //display success message
        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='index.php'>View Result</a>";
    }
}
?>
</body>

</html>
