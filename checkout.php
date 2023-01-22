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
    <title>Checkout &bull; CompTech</title>
</head>
<body>
<?php showHeader(); ?>
<main>
    <div class="checkout-container">
        <div class="card">
            <div class="card-title">
                <span>Checkout</span>
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $uid = $_SESSION["user"]["id"];
                    $sql = "SELECT * FROM purchase p JOIN product pd ON p.product_id = pd.id WHERE p.user_id = $uid AND purchased = 0 ORDER BY date_time DESC;";
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
                            echo "<td> ×" . $row["quantity"] . "</td>";
                            echo "<td>" . number_format($row["quantity"] * $row["price"], 2) . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <form action="confirm-payment.php" method="POST">
            <?php
            $sql = "SELECT SUM(price * quantity) as sum FROM purchase p JOIN product pd ON p.product_id = pd.id WHERE p.user_id = $uid AND purchased = 0;";
            $res = $conn->query($sql);
            $aggregatedSum = $res->fetch_assoc()["sum"];

            ?>
            <fieldset>
                <legend>Payment information</legend>
                <div class="auto-grid">
                    <div class="form-group">
                        <label>Card holder name
                            <input name="full_name" required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Card number
                            <input name="card_no" required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Expiry
                            <input name="card_expiry" placeholder="MM/YY" required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label><span class="spacer">
                            <input type="checkbox" required>
                                I have read and accepted the <a href="#">terms and conditions</a>
                            </span>
                        </label>
                    </div>
                    <small class="text-secondary">
                        Total sum is $<?= number_format($aggregatedSum, 2) ?> including VAT and shipping
                    </small>
                    <div class="form-group">
                        <button type="submit" class="primary full-width">Continue</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</main>
<script src="./assets/js/main.js"></script>
</body>
</html>
