<?php
include "services/auth_required.php";
include "services/db_connect.php";
include "services/helper.php";

$uid = $_SESSION["user"]["id"];
$sql = "SELECT *, p.id as purchase_id FROM purchase p JOIN product pd ON p.product_id = pd.id WHERE p.user_id = $uid AND purchased = 0 ORDER BY date_time DESC;";
$res = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>My Cart &bull; CompTech</title>
</head>
<body>
<?php showHeader(); ?>
<main>
    <div class="card">
        <div class="card-title">
            <span>My Cart</span>
            <div class="spacer">
                <?php if ($res->num_rows > 0) { ?>
                    <a href="checkout.php">
                        <button class="primary">Checkout</button>
                    </a>
                <?php } ?>
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
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($res->num_rows == 0) {
                    echo "<tr><td colspan='7'>No record.</td></tr>";
                } else {
                    while ($row = $res->fetch_assoc()) {
                        $purchase_id = $row["purchase_id"];

                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["model"] . "</td>";
                        echo "<td>" . $row["brand"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td>";
                        echo "<div class='spacer mx-auto'>";
                        echo "<a href='services/process.php?action=dec-in-cart&id=$purchase_id'><button class='primary'>-</button></a>";
                        echo "<span>" . $row["quantity"] . "</span>";
                        echo "<a href='services/process.php?action=inc-in-cart&id=$purchase_id'><button class='primary'>+</button></a>";
                        echo "</div>";
                        echo "</td>";
                        echo "<td>" . number_format($row["quantity"] * $row["price"], 2) . "</td>";
                        echo "<td>";
                        echo "<a href='services/process.php?action=del-in-cart&id=$purchase_id'><button class='danger'>Remove</button></a>";
                        echo "</td>";
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
