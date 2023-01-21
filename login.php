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
    <link rel="stylesheet" href="./assets/css/styles.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login &bull; CompTech</title>
</head>
<body>
<div class="page-logo">
    CompTech<sup>&trade;</sup>
</div>
<form action="services/process.php" method="POST" autocomplete="off" id="login-form">
    <?php showSessionAlert(); ?>
    <fieldset>
        <legend>Log into your account</legend>
        <div class="auto-grid">
            <div class="form-group">
                <label>
                    Username or email
                    <input name="identifier" required>
                </label>
            </div>
            <div class="form-group">
                <label>
                    Password <input type="password" name="password" required>
                </label>
            </div>
        </div>

        <button type="submit" name="login" class="my-2 primary">Login</button>

        <div>Not registered yet? <a href="register.php">Create an account</a></div>
    </fieldset>
</form>
</body>
</html>
