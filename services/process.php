<?php
include "./db_connect.php";
include "./helper.php";

session_start();

// Handle login request
if (isset($_POST["login"])) {
    $id = mysqli_real_escape_string($conn, $_POST["identifier"]);
    $pass = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM user WHERE email = '$id' OR username = '$id';";
    $res = $conn->query($sql);

    if ($res->num_rows == 0) {
        // Don't give the user too much details
        setSessionAlert("Invalid credentials", "error");
        header("Location: ../login.php");
        exit();
    }

    $row = $res->fetch_assoc();

    if (!password_verify($pass, $row["password"])) {
        setSessionAlert("Invalid credentials", "error");
        header("Location: ../login.php");
        exit();
    }

    $_SESSION["user"] = array(
        "id" => $row["id"],
        "first_name" => $row["first_name"],
        "last_name" => $row["last_name"],
        "username" => $row["username"],
        "email" => $row["email"]
    );

    header("Location: ../index.php");
} // Handle registration request
elseif (isset($_POST["register"])) {
    $firstName = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $lastName = mysqli_real_escape_string($conn, $_POST["last_name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $passwordRetype = mysqli_real_escape_string($conn, $_POST["password_retype"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);

    if ($username == 'admin' || $email == 'admin@comptech.com') {
        setSessionAlert("Reserved username/email in use", "error");
        header("Location: ../register.php");
        exit();
    }

    if ($password != $passwordRetype) {
        setSessionAlert("Passwords do not match", "error");
        header("Location: ../register.php");
        exit();
    }

    $sql = "SELECT * FROM user WHERE email = '$email' OR username = '$username';";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();

        if ($row['username'] == $username) {
            setSessionAlert("User with that username already exist", "error");
            header("Location: ../register.php");
        } elseif ($row['email'] == $email) {
            setSessionAlert("User with that email already exist", "error");
            header("Location: ../register.php");
        }

        exit();
    }

    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (first_name, last_name, username, email, password, address, phone) 
            VALUES ('$firstName','$lastName','$username','$email','$hashedPass','$address','$phone');";

    $res = $conn->query($sql);

    if ($res) {
        setSessionAlert("Registration completed successfully", "success");
        header("Location: ../login.php");
    } else {
        setSessionAlert("Registration failed", "error");
        header("Location: ../login.php");
    }
} elseif (isset($_POST["add-product"])) {
    if (!isAdmin()) die("403: Access denied");

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $model = mysqli_real_escape_string($conn, $_POST["model"]);
    $brand = mysqli_real_escape_string($conn, $_POST["brand"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);

    $sql = "INSERT INTO product (brand, model, name, description, price) 
        VALUES ('$brand', '$model', '$name', '$description', $price);";

    $res = $conn->query($sql);

    if ($res) {
        setSessionAlert("Product added successfully", "success");
    } else {
        setSessionAlert("Error adding new product: " . $conn->error, "error");
    }

    header("Location: ../products.php");
} elseif (isset($_POST["update-product"]) && isset($_GET["product-id"])) {
    if (!isAdmin()) die ("403: Access denied");

    $productId = $_GET["product-id"];

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $model = mysqli_real_escape_string($conn, $_POST["model"]);
    $brand = mysqli_real_escape_string($conn, $_POST["brand"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);

    $sql = "UPDATE product SET name = '$name', model = '$model', brand = '$brand', description = '$description', price = '$price'
    WHERE id = '$productId';";
    $res = $conn->query($sql);

    if ($res) {
        setSessionAlert("Product updated successfully", "success");
    } else {
        setSessionAlert("Error updating product: " . $conn->error, "error");
    }

    header("Location: ../products.php");
} else if (isset($_GET["action"]) && isset($_GET["product-id"])) {
    $action = $_GET["action"];
    $productId = $_GET["product-id"];

    if ($action == "del-product") {
        if (!isAdmin()) die("403: Access denied");

        $sql = "DELETE FROM product WHERE id = $productId;";
        $res = $conn->query($sql);

        if ($res) {
            setSessionAlert("Product deleted successfully", "success");
        } else {
            setSessionAlert("Error deleting product: " . $conn->error, "error");
        }

        header("Location: ../products.php");
    } elseif ($action == "add-to-cart") {
        if (!isset($_SESSION["user"])) {
            header("Location: login.php");
            exit();
        }

        $uid = $_SESSION["user"]["id"];
        $sql = "SELECT * FROM purchase WHERE product_id = $productId AND user_id = $uid AND purchased = 0;";
        $res = $conn->query($sql);

        if ($res->num_rows == 0) {
            $sql = "INSERT INTO purchase (product_id, user_id) VALUES ($productId, $uid)";
            $res = $conn->query($sql);
        } else {
            $rowId = $res->fetch_assoc()["id"];
            $sql = "UPDATE purchase SET quantity = quantity + 1 WHERE id = $rowId";
            $res = $conn->query($sql);
        }

        if ($res) {
            setSessionAlert("Product added to cart", "success");
        } else {
            setSessionAlert("Error adding product to cart: " . $conn->error, "error");
        }

        header("Location: ../products.php");
    } else {
        die("Forbidden");
    }
} elseif (isset($_POST["logout"])) {
    session_destroy();
    unset($_SESSION["user"]);
    header("Location: ../login.php");
} else {
    die("Forbidden");
}
?>