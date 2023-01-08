<?php
include "services/auth_required.php";

if ($_SESSION['user']['username'] != 'admin') {
    echo "Access denied! Redirecting...";
    header("Refresh: 3; url=index.php");
    exit();
}
?>