<?php
include "services/auth_required.php";
include "services/db_connect.php";
include "services/helper.php";

$search = "";

if (isset($_GET["search"])) {
    $search = strtolower($_GET["search"]);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>Products &bull; CompTech</title>
</head>
<body>
<?php showHeader(); ?>
<main>
    <aside>
        <?php showSessionAlert(); ?>
    </aside>
    <div class="card">
        <div class="card-title">
            <span>Products</span>
            <div class="spacer">
                <form action="products.php">
                    <input type="search" name="search" value="<?= $search ?>" placeholder="Search by name">
                </form>
                <?php
                if (isAdmin()) echo "<a href='add-product.php'><button class='primary'>Add product</button></a>";
                ?>
            </div>
        </div>
        <div class="card-body">
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
                if ($search == "") {
                    $sql = "SELECT * FROM product ORDER BY createdAt DESC;";
                } else {
                    $sql = "SELECT * FROM product WHERE LOWER(name) LIKE '%$search%' ORDER BY createdAt DESC;";
                }
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
                        echo "<div class='spacer mx-auto'>";
                        echo "<a href='product-details.php?id=$id'><button  class='info'>View more</button></a>";
                        if (isAdmin()) {
                            echo "<a href='update-product.php?id=$id'><button class='secondary'>Edit</button></a>";
                            echo "<button onclick='handleProdDel(`$id`)' class='danger'>Delete</button>";
                        } else {
                            echo "<a href='services/process.php?action=add-to-cart&product-id=$id' class='primary'><button class='primary'>Add to cart</button></a>";
                        }
                        echo "</div>";
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
