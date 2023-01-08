<?php include "services/auth_required.php"; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Site Name</title>
</head>
<body>
<h1>Welcome to the site <?php echo $_SESSION["user"]["username"] ?></h1>
<form action="services/process.php" method="POST">
    <input type="submit" value="Logout" name="logout">
</form>
</body>
</html>
