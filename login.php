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
    <title>Login &bull; Site Name</title>
</head>
<body>
<form action="services/process.php" method="POST">
    <?php showSessionAlert(); ?>
    <fieldset>
        <legend>Login</legend>
        <label>
            Username or email: <input type="text" name="identifier" required>
        </label>
        <br>
        <label>
            Password: <input type="password" name="password" required>
        </label>
        <br>
        <input type="submit" value="Login" name="login"> <br>
        <p>Not registered yet? <a href="register.php">Create an account</a></p>
    </fieldset>
</form>
</body>
</html>
