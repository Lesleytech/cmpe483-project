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
    <title>Products &bull; Site Name</title>
</head>
<body>
<h1>Products</h1>
<?php
if (isAdmin()) echo "<a href='add-product.php'><button>Add product</button></a><br /><br />";
?>
<?php showSessionAlert(); ?>
<table>
    <thead>
    <tr>
        <?php if (isAdmin()) echo "<th>ID</th>"; ?>
        <th>Name</th>
        <th>Model</th>
        <th>Brand</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT * FROM product ORDER BY createdAt DESC;";
    $res = $conn->query($sql);

    if ($res->num_rows == 0) {
        echo "<tr><td colspan='6'>No record.</td></tr>";
    } else {
        while ($row = $res->fetch_assoc()) {
            $id = $row["id"];

            echo "<tr>";
            if (isAdmin()) echo "<td>" . $id . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["model"] . "</td>";
            echo "<td>" . $row["brand"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td>";
            echo "<a href='product-details.php?id=$id'><button>View more</button></a>";
            if (isAdmin()) {
                echo "<a href='update-product.php?id=$id'><button>Edit</button></a>";
                echo "<a href='services/process.php?action=del-product&product-id=$id'><button>Delete</button></a>";
            } else {
                echo "<a href='services/process.php?action=add-to-cart&product-id=$id'><button>Add to cart</button></a>";
            }
            echo "</td>";
            echo "</tr>";
        }
    }
    ?>
    </tbody>
</table>
</body>
</html>
