<?php
session_start();
include '../includes/database.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>c.Shop</title>
    <!-- CSS LINK -->
    <link rel="stylesheet" href="../css/style.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <header>
        <figure>
            <h1>c.Shop</h1>
        </figure>
        <nav class="navigation close-nav">
            <a href="../index.php">HOME</a>
            <a href="../views/products.php">PRODUCT</a>
            <a href="../views/about.php">ABOUT</a>
            <a href="../views/contact.php">CONTACT</a>
        </nav>
        <div class="box-menu" id="menu-bar"><i class='bx bx-menu'></i></div>
        <script>
            function userIcon() {
                document.getElementById("userDrop").classList.toggle("show-user");
            };

            function cartIcon() {
                document.getElementById("cartDrop").classList.toggle("show-cart");
            };
        </script>
        <section class="user-content">
            <div class="user-box">
                <button onclick="userIcon()"><img src="../images/user.svg" alt="user"></button>
            </div>

            <?php
            if (isset($_SESSION['userlog_in'])) { ?>
                <div id="userDrop" class="userbox-content">
                    <a href="../includes/process.php?logout"><button class="btn-signIn">Sign Out</button></a>
                </div>
            <?php } else { ?>
                <div id="userDrop" class="userbox-content">
                    <a href="../auth/signIn.php"><button class="btn-signIn">Sign In</button></a>
                </div>
            <?php } ?>

            <div id="userDrop" class="userbox-content">
                <a href="../auth/signIn.php"><button class="btn-signIn">Sign In</button></a>
            </div>

            <div class="cart-box">

                <?php if (isset($_SESSION['userlog_in'])) { ?>

                    <?php
                    $user_ID = $_SESSION['u_ID'];

                    $countCart = "SELECT COUNT(user_ID)  FROM cart WHERE user_ID=?";
                    $countCart = $conn->prepare($countCart);
                    $countCart->execute([$user_ID]);

                    $totalCart = $countCart->fetchColumn(); ?>

                    <?php if ($totalCart > 0) { ?>
                        <button onclick="cartIcon()"><img src="../images/cart.svg" alt="cart">
                            <span class="count-cart"><?= $totalCart ?></span>
                        </button>
                    <?php } else { ?>
                        <button onclick="cartIcon()"><img src="../images/cart.svg" alt="cart"></button>
                    <?php } ?>

                <?php } else { ?>
                    <button onclick="cartIcon()"><img src="../images/cart.svg" alt="cart"></button>
                <?php } ?>

            </div>

            <div id="cartDrop" class="cart-content">
                <div class="cart-container">

                    <?php if (isset($_SESSION['userlog_in'])) { ?>

                        <?php
                        $userCartID = $_SESSION['u_ID'];

                        $showCart = $conn->prepare("SELECT * FROM cart WHERE user_ID=?");
                        $showCart->execute([$userCartID]);

                        foreach ($showCart as $show) { ?>


                            <div class="cart-order">
                                <figure class="img-order">
                                    <img src="../images/<?= $show['productImage'] ?>" alt="4">
                                </figure>
                                <section class="order-text">
                                    <div class="order-title">
                                        <h1><?= $show['productName'] ?></h1>
                                        <h1>₱<?= $show['productPrice'] ?></h1>
                                    </div>
                                    <div class="btn-order">
                                        <a href="../includes/process.php?checkOut&c_id=<?= $show['c_ID'] ?>&u_id=<?= $show['user_ID'] ?>&name=<?= $show['productName'] ?>&price=<?= $show['productPrice'] ?>&image=<?= $show['productImage'] ?>" type="button">Check Out</a>
                                    </div>
                                </section>
                            </div>

                        <?php } ?>

                    <?php } ?>

                    <?php if (empty($show)) { ?>

                        <div class="no-order">
                            <h1>No Orders yet!</h1>
                        </div>

                    <?php } ?>


                    <?php if (isset($_SESSION['userlog_in'])) { ?>

                        <?php
                        $user_ID = $_SESSION['u_ID'];

                        $countOrder = "SELECT COUNT(user_ID)  FROM orders WHERE user_ID=?";
                        $countOrder = $conn->prepare($countOrder);
                        $countOrder->execute([$user_ID]);

                        $totalOrder = $countOrder->fetchColumn(); ?>

                        <?php if ($totalOrder > 0) { ?>
                            <div class="btn-afterOrder">
                                <a href="../cart/orders.php" type="button">Orders<span class="count-order"><?= $totalOrder ?></span></a>
                            </div>
                        <?php } ?>

                    <?php } ?>

                    
                </div>
            </div>
        </section>
    </header>

</body>

</html>