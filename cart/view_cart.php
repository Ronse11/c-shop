<?php
    session_start();
    include '../includes/database.php';
    
    if(!isset($_SESSION['userlog_in'])) {
        header("Location: ../auth/signIn.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>
    <section class="order-container">
        <section class="order-content">
            
            <?php
            if(isset($_GET['selected'])) { 
            $p_ID = $_GET['id'];
            
            $showCart = $conn->prepare("SELECT * FROM product WHERE p_ID = ?");
            $showCart->execute([$p_ID]);

            foreach($showCart as $cart) { ?>
                <section class="order-box">
                    <figure class="order-img">
                        <img src="../images/<?=$cart['productImage']?>" alt="Cart Product">
                    </figure>
                    <article class="cart-content">
                        <div class="order-title">
                            <h1><?=$cart['productName']?></h1>
                            <h1>₱<?=$cart['productPrice']?></h1>
                        </div>
                        <div class="btn-order">
                            <a href="../includes/process.php?addCart&id=<?=$cart['p_ID']?>&name=<?=$cart['productName']?>&price=<?=$cart['productPrice']?>&image=<?=$cart['productImage']?>" type="button">Add to Cart</a>
                            <a href="../views/products.php" type="button">Cancel</a>
                        </div>
                    </article>
                </section>
            <?php } ?>
            <?php } ?>

        </section>
    </section>
</body>
</html>