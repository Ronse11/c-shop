<?php
include '../includes/process.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="../css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <section class="admin-container">
        <aside class="admin-btns">
            <section class="text-logo">
                <h1>c.Shop</h1>
            </section>
            <a href="./admin_dashboard.php" type="button"><i class='bx bxs-dashboard' ></i>Dashboard</a>
            <a href="./admin_products.php" type="button" class="active"><i class='bx bxs-store'></i>Products</a>
            <a href="./admin_add.php" type="button"><i class='bx bxs-plus-square'></i>Add</a>
        </aside>
        <section class="dash-content">

            <header class="admin-header">
                <script>
                    function adminIcon() {
                        document.getElementById('adminDrop').classList.toggle('show-admin');
                    }
                </script>

                <?php
                $userID = $_SESSION['u_ID'];

                $getUserName = $conn->prepare("SELECT firstName FROM user WHERE userID = ?");
                $getUserName->execute([$userID]); ?>
                <?php foreach ($getUserName as $userName) { ?>
                    <div class="admin-box">
                        <button onclick="adminIcon()"><i class='bx bxs-user'></i><?= $userName['firstName'] ?></button>
                    </div>
                <?php } ?>

                <?php
                if (isset($_SESSION['userlog_in'])) { ?>
                    <div id="adminDrop" class="adminbox-content">
                        <a href="../includes/process.php?logout"><button class="btn-admin">Sign Out</button></a>
                    </div>
                <?php } ?>
            </header>

            <section class="admin-title">
                <h1>Products</h1>
            </section>

            <section class="main-container">
                <section class="product-container">

                    <?php 
                    $userID = $_SESSION['u_ID'];

                    $getProduct = $conn->prepare("SELECT * FROM product WHERE userID = ?");
                    $getProduct->execute([$userID]);
                    ?>
                    <?php foreach($getProduct as $product) {?>
                        <section class="product-holder">
                            <div class="product-box">
                                <figure class="prdct-img">
                                    <img src="../images/<?=$product['productImage']?>" alt="Product Image">
                                </figure>
                                <h1><?=$product['productName']?></h1>
                                <h1>₱<?=$product['productPrice']?></h1>
                                <div class="prdct-btn">
                                    <a href="./admin_add.php?edit&id=<?=$product['p_ID']?>" type="button">Edit</a>
                                    <a href="../includes/process.php?delete&id=<?=$product['p_ID']?>" type="button">Delete</a>
                                </div>
                            </div>
                        </section>
                    <?php } ?>

                </section>
            </section>
        </section>
    </section>
</body>
</html>