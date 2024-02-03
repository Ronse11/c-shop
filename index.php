<?php
session_start();
include './includes/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>c.Shop</title>
    <!-- CSS LINK -->
    <link rel="stylesheet" href="./css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <header>
        <figure>
            <h1>c.Shop</h1>
        </figure>
        <nav class="navigation close-nav">
            <a href="index.php">HOME</a>
            <a href="./views/products.php">PRODUCT</a>
            <a href="./views/about.php">ABOUT</a>
            <a href="./views/contact.php">CONTACT</a>
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
                <button onclick="userIcon()"><img src="./images/user.svg" alt="user"></button>
            </div>

            <?php
            if (isset($_SESSION['userlog_in'])) { ?>
                <div id="userDrop" class="userbox-content">
                    <a href="./includes/process.php?logout"><button class="btn-signIn">Sign Out</button></a>
                </div>
            <?php } else { ?>
                <div id="userDrop" class="userbox-content">
                    <a href="./auth/signIn.php"><button class="btn-signIn">Sign In</button></a>
                </div>
            <?php } ?>

            <div class="cart-box">

                <?php if (isset($_SESSION['userlog_in'])) { ?>

                    <?php
                    $user_ID = $_SESSION['u_ID'];

                    $countCart = "SELECT COUNT(user_ID) FROM cart WHERE user_ID=?";
                    $countCart = $conn->prepare($countCart);
                    $countCart->execute([$user_ID]);

                    $totalCart = $countCart->fetchColumn(); ?>

                    <?php if ($totalCart > 0) { ?>
                        <button onclick="cartIcon()"><img src="./images/cart.svg" alt="cart">
                            <span class="count-cart"><?= $totalCart ?></span>
                        </button>
                    <?php } else { ?>
                        <button onclick="cartIcon()"><img src="./images/cart.svg" alt="cart"></button>
                    <?php } ?>

                <?php } else { ?>
                    <button onclick="cartIcon()"><img src="./images/cart.svg" alt="cart"></button>
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
                                    <img src="./images/<?= $show['productImage'] ?>" alt="4">
                                </figure>
                                <section class="order-text">
                                    <div class="order-title">
                                        <h1><?= $show['productName'] ?></h1>
                                        <h1>₱<?= $show['productPrice'] ?></h1>
                                    </div>
                                    <div class="btn-order">
                                        <a href="./includes/process.php?checkOut&c_id=<?= $show['c_ID'] ?>&u_id=<?= $show['user_ID'] ?>&name=<?= $show['productName'] ?>&price=<?= $show['productPrice'] ?>&image=<?= $show['productImage'] ?>" type="button">Check Out</a>
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

                        $countOrder = "SELECT COUNT(user_ID) FROM orders WHERE user_ID=?";
                        $countOrder = $conn->prepare($countOrder);
                        $countOrder->execute([$user_ID]);

                        $totalOrder = $countOrder->fetchColumn(); ?>

                        <?php if ($totalOrder > 0) { ?>
                            <div class="btn-afterOrder">
                                <a href="./cart/orders.php" type="button">Orders<span class="count-order"><?= $totalOrder ?></span></a>
                            </div>
                        <?php } ?>

                    <?php } ?>

                </div>
            </div>
        </section>
    </header>

    <section class="landing">
        <figure class="head-img">
            <img src="./images/landing left.png" alt="head" class="head1">
        </figure>
        <article class="content-box">
            <h1>acoustic elegance</h1>
            <h2>refined sound, an epitome of acoustic elegance.</h2>
            <section class="btn-starter">
                <a href="./index.php"><button>Get Started</button></a>
                <a href="./views/products.php"><button>Shop Now</button></a>
            </section>
        </article>
        <figure class="head-img">
            <img src="./images/landing hp.png" alt="head" class="head2">
        </figure>
    </section>

    <section class="main-page">
        <article class="product-title">
            <h1>Headphones</h1>
        </article>
        <section class="product-content">
            <?php
            $getAllProduct = $conn->prepare("SELECT * FROM product");
            $getAllProduct->execute();

            foreach ($getAllProduct as $allProduct) { ?>
                <a href="./cart/view_cart.php?selected&id=<?= $allProduct['p_ID'] ?>" class="product-box">
                    <figure class="image-box">
                        <img src="./images/<?= $allProduct['productImage'] ?>" alt="Product">
                    </figure>
                    <article class="product-name">
                        <h1><?= $allProduct['productName'] ?></h1>
                        <h2>₱<?= $allProduct['productPrice'] ?></h2>
                    </article>
                </a>
            <?php } ?>

        </section>
    </section>

    <section class="main-page">
        <article class="title-text">
            <h1>About Us</h1>
        </article>
        <article class="about-intro">
            <p>Acoustic Elegance is more than a business, it is a testament to the harmonious fusion of passion, innovation, and a deep appreciation for the art of sound.</p>
        </article>
        <section class="about-content">
            <article class="about-box">
                <article class="box-content">
                    <p>At the core of Acoustic Elegance is a group of individuals who share an unyielding love for music. We are audiophiles, engineers, and creatives driven by the belief that audio is an experience, a journey that transcends the ordinary.</p>
                </article>
                <figure class="box-image">
                    <img src="./images/headBW.jpg" alt="2">
                </figure>
            </article>
            <article class="about-box">
                <figure class="box-image">
                    <img src="./images/headBW.jpg" alt="2">
                </figure>
                <article class="box-content">
                    <p>What sets us apart is our unwavering passion for sound. We understand that music is not just heard, it is felt. Our commitment to delivering an unpararelled audio experience fuels our constant exploration of cutting edge technologies and innovative design, ensuring that every note is delivered with precision clarity.</p>
                </article>
            </article>
        </section>
    </section>

    <section class="contact-page">
        <h1>Contact Us?</h1>
        <section class="contact-container">
            <form action="">
                <article class="contact-box">
                    <div class="input-box">
                        <label for="fname">Full Name*</label>
                        <input type="text" id="fname">
                    </div>
                    <div class="input-box">
                        <label for="user_email">Email*</label>
                        <input type="email" id="user_email">
                    </div>
                    <div class="input-box">
                        <label for="cnumber">Contact No*</label>
                        <input type="text" id="cnumber">
                    </div>
                    <div class="input-box">
                        <label for="des">Your Inquiry*</label>
                        <textarea name="des" id="des" cols="30" rows="10"></textarea>
                    </div>
                    <div class="input-btn">
                        <button>Submit</button>
                    </div>
                </article>
            </form>
        </section>
    </section>

    <script src="./js/main.js"></script>
</body>

</html>