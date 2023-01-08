<?php
function setSessionAlert($message, $type)
{
    $_SESSION["alert"] = array("message" => $message, "type" => $type);
}

function showSessionAlert()
{
    if (isset($_SESSION["alert"])) {
        echo "<div>" . $_SESSION["alert"]["message"] . "</div>";
        unset($_SESSION["alert"]);
    }
}

function isAdmin()
{
    if (!isset($_SESSION["user"])) return false;

    return $_SESSION["user"]["username"] == 'admin';
}

?>