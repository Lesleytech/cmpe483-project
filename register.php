<?php
session_start();
include "services/helper.php";

if (isset($_SESSION['user'])) {
    echo "You are logged in! Redirecting...";
    header("Refresh: 3; url=index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register &bull; Site Name</title>
</head>
<body>
<form action="services/process.php" method="POST">
    <?php showSessionAlert(); ?>
    <fieldset>
        <legend>Register</legend>
        <label>
            First name: <input type="text" name="first_name" required>
        </label>
        <br>
        <label>
            Last name: <input type="text" name="last_name" required>
        </label>
        <br>
        <label>
            Username: <input type="text" name="username" required>
        </label>
        <br>
        <label>
            Email: <input type="email" name="email" required>
        </label>
        <br>
        <label>
            Address: <input type="text" name="address" required>
        </label>
        <br>
        <label>
            Telephone: <input type="text" name="telephone" required>
        </label>
        <br>
        <label>
            Password: <input type="password" name="password" required>
        </label>
        <br>
        <label>
            Retype password: <input type="password">
        </label>
        <br>
        <input type="submit" value="Register" name="register">
        <p>Already registered? <a href="login.php">Login to your account</a></p>
    </fieldset>
</form>
</body>
</html>
