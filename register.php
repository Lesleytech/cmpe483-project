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
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>Register &bull; CompTech</title>
</head>
<body>
<div class="page-logo">
    CompTech<sup>&trade;</sup>
</div>
<form action="services/process.php" method="POST" id="register-form" onsubmit="handleSignUp(event);">
    <?php showSessionAlert(); ?>
    <fieldset>
        <legend>Create a new account</legend>
        <div class="auto-grid">
            <div class="form-group">
                <label>
                    First name <input name="first_name" required>
                </label>
            </div>
            <div class="form-group">
                <label>
                    Last name <input type="text" name="last_name" required>
                </label>
            </div>
            <div class="form-group">
                <label>
                    Username <input type="text" name="username" required>
                </label>
            </div>
            <div class="form-group">
                <label>
                    Email <input type="email" name="email" required>
                </label>
            </div>
            <div class="form-group">
                <label>
                    Address <input type="text" name="address" required>
                </label>
            </div>
            <div class="form-group">
                <label>
                    Phone <input type="text" name="phone" required>
                </label>
            </div>
            <div class="form-group">
                <label>
                    Password <input type="password" name="password" required minlength="4">
                </label>
            </div>
            <div class="form-group">
                <label>
                    Retype password <input type="password" name="password_retype" required minlength="4">
                </label>
            </div>
        </div>
        <button type="submit" name="register" class="my-2 primary">
            Create account
        </button>
        <div>Already registered? <a href="login.php">Login to your account</a></p></div>
    </fieldset>
</form>

<script src="./assets/js/main.js"></script>
</body>
</html>
