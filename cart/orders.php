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

    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <section class="order-container">
        <section class="order-wrapper">
            <div class="btn-back">
                <a href="../index.php" type="button"><i class='bx bx-arrow-back'></i></a>
            </div>
            <section class="order-holder">

                <?php
                if (isset($_SESSION['userlog_in'])) {
                    $userID = $_SESSION['u_ID'];

                    $showOrder = $conn->prepare("SELECT * FROM orders WHERE user_ID=?");
                    $showOrder->execute([$userID]);

                    foreach ($showOrder as $order) { ?>

                        <section class="order-table">
                            <fifure class="order-img">
                                <img src="../images/<?= $order['imageFile'] ?>" alt="image">
                            </fifure>
                            <div class="order-name">
                                <h1><?= $order['productName'] ?></h1>
                            </div>
                            <div class="order-price">
                                <h1>₱<?= $order['productPrice'] ?></h1>
                            </div>
                            <div class="order-action">
                                <a href="../includes/process.php?receive&id=<?= $order['o_ID'] ?>" type="button">
                                    <h1>Received</h1>
                                </a>
                            </div>
                        </section>

                        <?php if (empty($order)) { ?>

                            <section class="no-orders">
                                <h1>No Orders yet!</h1>
                            </section>

                        <?php } ?>

                    <?php } ?>
                <?php } ?>

            </section>
        </section>
    </section>
</body>

</html>