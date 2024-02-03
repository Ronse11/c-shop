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
            <a href="./admin_dashboard.php" type="button"><i class='bx bxs-dashboard'></i>Dashboard</a>
            <a href="./admin_products.php" type="button"><i class='bx bxs-store'></i>Products</a>
            <a href="./admin_add.php" type="button" class="active"><i class='bx bxs-plus-square'></i>Add</a>
        </aside>
        <section class="dash-content">

            <header class="admin-header">
                <script   script>
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
                <h1>Add Product</h1>
            </section>
            <!-- CRUD OPERATION HERE -->
            <?php 
            if(isset($_GET['edit'])) { 
            $p_ID = $_GET['id']; 
            
            $editProduct = $conn->prepare("SELECT * FROM product WHERE p_ID = ?");
            $editProduct->execute([$p_ID]);

            foreach($editProduct as $edit) {?>

            <section class="add-container">
                <form action="../includes/process.php" method="post">
                    <section class="add-card">
                        <div class="input-box">
                            <label for="img_product">Image File :</label>
                            <input type="hidden" name="userID" value="<?=$edit['p_ID']?>">
                            <input type="file" id="img_product" accept=".jpg,.jpeg,.png" name="img_product">
                        </div>
                        <div class="input-box">
                            <label for="product_name">Product Name :</label>
                            <input type="text" id="product_name" name="product_name" value="<?=$edit['productName']?>">
                        </div>
                        <div class="input-box">
                            <label for="product_price">Product Price :</label>
                            <input type="text" id="product_price" name="product_price" value="<?=$edit['productPrice']?>">
                        </div>
                        <div class="input-btn">
                            <button name="update">Submit</button>
                        </div>
                    </section>
                </form>
            </section>

            <?php } ?>
            <?php } else { ?>

            <section class="add-container">
                <form action="../includes/process.php" method="post">
                    <section class="add-card">
                        <div class="input-box">
                            <label for="img_product">Image File :</label>
                            <input type="hidden" name="userID" value="<?=$_SESSION['u_ID']?>">
                            <input type="file" id="img_product" accept=".jpg,.jpeg,.png" name="img_product">
                        </div>
                        <div class="input-box">
                            <label for="product_name">Product Name :</label>
                            <input type="text" id="product_name" name="product_name">
                        </div>
                        <div class="input-box">
                            <label for="product_price">Product Price :</label>
                            <input type="text" id="product_price" name="product_price">
                        </div>
                        <div class="input-btn">
                            <button name="upload">Submit</button>
                        </div>
                    </section>
                </form>
            </section>

            <?php } ?>

        </section>
    </section>
</body>

</html>