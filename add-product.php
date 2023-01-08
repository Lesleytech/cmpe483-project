<?php
include "services/admin_auth_required.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product &bull; Site Name</title>
</head>
<body>
<form action="services/process.php" method="POST">
    <fieldset>
        <legend>Add Product</legend>
        <label>
            Product name: <input name="name" required>
        </label>
        <br>
        <label>
            Model: <input name="model" required>
        </label>
        <br>
        <label>
            Brand: <input name="brand" required>
        </label>
        <br>
        <label>
            Description: <input name="description" required>
        </label>
        <br>
        <label>
            Price: <input type="number" name="price" required>
        </label>
        <br>
        <input type="submit" value="Add Product" name="add-product">
    </fieldset>
</form>
</body>
</html>
