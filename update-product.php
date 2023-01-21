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
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>Update Product &bull; Site Name</title>
</head>
<body>
<form action="services/process.php?product-id=<?php echo $product_id ?>" method="POST" id="update-product-form">
    <fieldset>
        <legend>Update Product</legend>
        <div class="auto-grid">
            <div class="form-group">
                <label>
                    Product name <input name="name" required value="<?php echo $product['name'] ?>">
                </label>
            </div>
            <div class="form-group">
                <label>
                    Model <input name="model" required value="<?php echo $product['model'] ?>">
                </label>
            </div>
            <div class="form-group">
                <label>
                    Brand <input name="brand" required value="<?php echo $product['brand'] ?>">
                </label>
            </div>
            <div class="form-group">
                <label>
                    Description <textarea name="description" rows="3" required><?= $product['description'] ?></textarea>
                </label>
            </div>
            <div class="form-group">
                <label>
                    Price <input type="number" name="price" required value="<?php echo $product['price'] ?>">
                </label>
            </div>
        </div>
        <button type="submit" name="update-product" class="my-2 primary">Update Product</button>
    </fieldset>
</form>
</body>
</html>
