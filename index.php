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
