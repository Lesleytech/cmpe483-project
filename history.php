<?php
include "services/auth_required.php";
include "services/db_connect.php";
include "services/helper.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>History &bull; CompTech</title>
</head>
<body>
<?php showHeader(); ?>
<main>
    <div class="card">
        <div class="card-title">
            <span>History</span>
            <div class="spacer">
            </div>
        </div>
        <div class="card-body">
            <table>
                <thead>
                <tr>
                    <th>Product name</th>
                    <th>Model</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $uid = $_SESSION["user"]["id"];
                $sql = "SELECT * FROM purchase p JOIN product pd ON p.product_id = pd.id WHERE p.user_id = $uid AND purchased = 1 ORDER BY date_time DESC;";
                $res = $conn->query($sql);

                if ($res->num_rows == 0) {
                    echo "<tr><td colspan='7'>No record.</td></tr>";
                } else {
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["model"] . "</td>";
                        echo "<td>" . $row["brand"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td> x" . $row["quantity"] . "</td>";
                        echo "<td>" . number_format($row["quantity"] * $row["price"], 2) . "</td>";
                        echo "<td>" . $row["date_time"] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="./assets/js/main.js"></script>
</body>
</html>
