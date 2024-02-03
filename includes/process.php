<?php
session_start();
include '../includes/database.php';

// USER PROCESS START HERE

// Register User
if (isset($_POST['register'])) {
    $f_name = $_POST['fname'];
    $l_name = $_POST['lname'];
    $u_email = $_POST['u_email'];
    $u_pass = $_POST['u_pass'];

    $hash = password_hash($u_pass, PASSWORD_DEFAULT);

    $registerUser = $conn->prepare("INSERT INTO user(firstName, lastName, eMailAddress, userPassword) VALUES(?, ? ,?, ?)");
    $registerUser->execute([
        $f_name,
        $l_name,
        $u_email,
        $hash
    ]);

    header("Location: ../auth/signIn.php");
    exit();
}

// Login User
if (isset($_POST['login'])) {
    $u_email = $_POST['u_email'];
    $u_pass = $_POST['u_pass'];

    $checkUser = $conn->prepare("SELECT * FROM user WHERE eMailAddress = ?");
    $checkUser->execute([$u_email]);

    foreach ($checkUser as $check) {
        if ($check['eMailAddress'] == $u_email && password_verify($u_pass, $check['userPassword'])) {
            $_SESSION['userlog_in'] = true;
            $_SESSION['u_ID'] = $check['userID'];

            if($check['role'] === 'admin') {
                header("Location: ../admin/admin_dashboard.php");
            } else {
                header("Location: ../index.php");
            }

        } else {
            $msg = "Password Incorrect!";
            header("Location: ../auth/signUp.php?msg=$msg");
        }
    }
}

//Logout User
if (isset($_GET['logout'])) {
    session_start();
    unset($_SESSION['userlog_in']);
    unset($_SESSION['u_ID']);

    header("Location: ../index.php");
}

if(isset($_GET['checkOut'])) {
    $c_ID = $_GET['c_id'];
    $user_ID = $_GET['u_id'];
    $prdctName = $_GET['name'];
    $prdctPrice = $_GET['price'];
    $image = $_GET['image'];

    $orderProduct = $conn->prepare("INSERT INTO orders(c_ID, user_ID, productName, productPrice, imageFile) VALUES(?, ?, ?, ?, ?)");
    $orderProduct->execute([$c_ID, $user_ID, $prdctName, $prdctPrice, $image]);

    $deleteCart = $conn->prepare("DELETE FROM cart WHERE c_ID=?");
    $deleteCart->execute([$c_ID]);

    header("Location: ../cart/orders.php");
}

// Receive Items
if(isset($_GET['receive'])) {
    $o_ID = $_GET['id'];

    $receiveOrder = $conn->prepare("DELETE FROM orders WHERE o_ID=?");
    $receiveOrder->execute([$o_ID]);

    header("Location: ../cart/orders.php");
}

// USER PROCESS ENDS HERE

// ADMIN PROCESS START HERE

// Insert Product
if(isset($_POST['upload'])) {
    $userID = $_POST['userID'];
    $prdctName = $_POST['product_name'];
    $prdctPrice = $_POST['product_price'];
    $imgFile = $_POST['img_product'];

    $uploadProduct = $conn->prepare("INSERT INTO product(userID, productName, productPrice, productImage) VALUES(?, ?, ?, ?)");
    $uploadProduct->execute([$userID, $prdctName, $prdctPrice, $imgFile]);

    header("Location: ../admin/admin_products.php");
}

// Update Product
if(isset($_POST['update'])) {
    $userID = $_POST['userID'];
    $prdctName = $_POST['product_name'];
    $prdctPrice = $_POST['product_price'];
    $imgFile = $_POST['img_product'];

    $updateProduct = $conn->prepare("UPDATE product SET productName=?, productPrice=?, productImage=? WHERE p_ID=?");
    $updateProduct->execute([$prdctName, $prdctPrice, $imgFile, $userID]);

    $msg = "Successfully Updated!";
    header("Location: ../admin/admin_products.php?msg=$msg");
    exit();
}

// Delete Product
if(isset($_GET['delete'])) {
    $userID = $_GET['id'];

    $deleteProduct = $conn->prepare("DELETE FROM product WHERE p_ID=?");
    $deleteProduct->execute([$userID]);

    header("Location: ../admin/admin_products.php");
    exit();
}

// Add to Cart
if(isset($_GET['addCart'])) {
    $p_ID = $_GET['id'];
    $userID = $_SESSION['u_ID'];
    $prdctName = $_GET['name'];
    $prdctPrice = $_GET['price'];
    $imgFile = $_GET['image'];

    $addToCart = $conn->prepare("INSERT INTO cart(p_ID, user_ID, productName, productPrice, productImage) VALUES(?,?,?,?,?)");
    $addToCart->execute([$p_ID, $userID, $prdctName, $prdctPrice, $imgFile]);

    header("Location: ../index.php");
}

// ADMIN PROCESS ENDS HERE

$pdo = null;
?>
