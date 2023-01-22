<?php
function setSessionAlert($message, $type)
{
    $_SESSION["alert"] = array("message" => $message, "type" => $type);
}

function showSessionAlert()
{
    if (isset($_SESSION["alert"])) {
        $message = $_SESSION["alert"]["message"];
        $type = $_SESSION["alert"]["type"];

        echo "<div class='alert $type'>$message</div>";
        unset($_SESSION["alert"]);
    }
}

function isAdmin()
{
    if (!isset($_SESSION["user"])) return false;

    return $_SESSION["user"]["username"] == 'admin';
}

function showHeader()
{
    $username = $_SESSION["user"]["username"];
    $uid = $_SESSION["user"]["id"];

    echo "<header>";
    echo "<a href='index.php'><strong class='logo'>CompTech<sup>TM</sup></strong></a>";
    echo "<div class='spacer'>";
    echo "<span>Hello, $username</span>";
    if (!isAdmin()) {
        include "services/db_connect.php";

        $sql = "SELECT * FROM purchase WHERE purchased = 0 AND user_id = $uid;";
        $res = $conn->query($sql);

        echo "<a href='cart.php'><button class='primary'>My cart ($res->num_rows)</button></a>";
        echo "<a href='history.php'><button class='info'>History</button></a>";
    }
    echo "<a href='logout.php'><button>Logout</button></a>";
    echo "</div>";
    echo "</header>";
}

?>