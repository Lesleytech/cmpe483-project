<?php
include "services/admin_auth_required.php";
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
    <title>Update Product &bull; Site Name</title>
</head>
<body>
<form action="services/process.php?product-id=<?php echo $product_id ?>" method="POST">
    <fieldset>
        <legend>Update Product</legend>
        <label>
            Product name: <input name="name" required value="<?php echo $product['name'] ?>">
        </label>
        <br>
        <label>
            Model: <input name="model" required value="<?php echo $product['model'] ?>">
        </label>
        <br>
        <label>
            Brand: <input name="brand" required value="<?php echo $product['brand'] ?>">
        </label>
        <br>
        <label>
            Description: <input name="description" required value="<?php echo $product['description'] ?>">
        </label>
        <br>
        <label>
            Price: <input type="number" name="price" required value="<?php echo $product['price'] ?>">
        </label>
        <br>
        <input type="submit" value="Update Product" name="update-product">
    </fieldset>
</form>
</body>
</html>
