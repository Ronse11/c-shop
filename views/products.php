<?php
    include '../includes/header.php';
?>

<main class="main-page">
        <article class="product-title">
            <h1>Headphones</h1>
        </article>
        <section class="product-content">
            <?php 
            $getAllProduct = $conn->prepare("SELECT * FROM product");
            $getAllProduct->execute();

            foreach($getAllProduct as $allProduct) {?>
                <a href="../cart/view_cart.php?selected&id=<?=$allProduct['p_ID']?>" class="product-box">
                    <figure class="image-box">
                        <img src="../images/<?=$allProduct['productImage']?>" alt="Product">
                    </figure>
                    <article class="product-name">
                        <h1><?=$allProduct['productName']?></h1>
                        <h2>₱<?=$allProduct['productPrice']?></h2>
                    </article>
                </a>
            <?php } ?>

        </section>
    </main>

<?php
    include '../includes/footer.php';
?>