<?php
include "services/auth_required.php";
include "services/db_connect.php";
include "services/helper.php";

if (!isset($_GET["id"])) die("Invalid product id");

$product_id = $_GET["id"];

$sql = "SELECT * FROM product WHERE id = $product_id";
$res = $conn->query($sql);

if ($res->num_rows == 0) {
    die("Product not found");
}

$product = $res->fetch_assoc();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php showHeader(); ?>
<main>
    <div class="card">
        <div class="card-title">
            <span>Product details</span>
            <div>
                <?php if (!isAdmin()) { ?>
                    <a href='services/process.php?action=add-to-cart&id=<?= $product_id ?>' class='primary'>
                        <button class='primary'>Add to cart</button>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="card-body">
            <table>
                <tbody>
                <tr>
                    <td><b>Product name</b></td>
                    <td><?= $product["name"] ?></td>
                </tr>
                <tr>
                    <td><b>Model</b></td>
                    <td><?= $product["model"] ?></td>
                </tr>
                <tr>
                    <td><b>Brand</b></td>
                    <td><?= $product["brand"] ?></td>
                </tr>
                <tr>
                    <td><b>Price</b></td>
                    <td><?= $product["price"] ?></td>
                </tr>
                <tr>
                    <td><b>Description</b></td>
                    <td><?= $product["description"] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>
