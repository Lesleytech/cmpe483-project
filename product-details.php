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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1><?php echo $product["name"] ?></h1>
<p>
    <span><b>Model:</b> <?php echo $product["model"] ?></span>
    <span><b>Brand:</b> <?php echo $product["brand"] ?></span>
    <span><b>Price:</b> <?php echo $product["price"] ?></span>
</p>
<p>
    <?php echo $product["description"] ?>
</p>
<?php
if (!isAdmin()) {
    echo "<a href='services/process.php?action=add-product-to-cart&id=$product_id'><button>Add to cart</button></a>";

}
?>
</body>
</html>
