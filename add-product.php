<?php
include "services/admin_auth_required.php";
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
    <title>Add Product &bull; Site Name</title>
</head>
<body>
<main>
    <form action="services/process.php" method="POST" id="add-product-form">
        <fieldset>
            <legend>Add Product</legend>
            <div class="auto-grid">
                <div class="form-group">
                    <label>
                        Product name <input name="name" required>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        Model <input name="model" required>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        Brand <input name="brand" required>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        Description <textarea name="description" rows="3" required></textarea>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        Price <input type="number" name="price" required min="1">
                    </label>
                </div>
            </div>
            <button type="submit" name="add-product" class="my-2 primary">Add Product</button>
        </fieldset>
    </form>
</main>
</body>
</html>
