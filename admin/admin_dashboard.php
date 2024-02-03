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
            <a href="" type="button" class="active"><i class='bx bxs-dashboard'></i>Dashboard</a>
            <a href="./admin_products.php" type="button"><i class='bx bxs-store'></i>Products</a>
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
                <h1>Dashboard</h1>
            </section>
            <section class="admin-engagement">

            <?php
            if(isset($_SESSION['userlog_in'])) { ?>
                <?php 
                $countUser = "SELECT COUNT(userID) FROM user";
                $countUser = $conn->prepare($countUser);
                $countUser->execute();

                $totalUser = $countUser->fetchColumn();
                ?>

                <?php
                if($totalUser > 0): ?>

                    <section class="engagement-box">
                        <div class="engagement-text">
                            <h1><?= $totalUser ?></h1>
                            <h2>Users</h2>
                        </div>
                        <div class="engagement-icon">
                            <i class='bx bxs-user-plus'></i>
                        </div>
                    </section>

                <?php endif; ?>
            <?php } ?>




                <section class="engagement-box">
                    <div class="engagement-text">
                        <h1>₱6,000</h1>
                        <h2>Income</h2>
                    </div>
                    <div class="engagement-icon">
                        <i class='bx bxs-bar-chart-alt-2'></i>
                    </div>
                </section>
                <section class="engagement-box">
                    <div class="engagement-text">
                        <h1>2K</h1>
                        <h2>Orders</h2>
                    </div>
                    <div class="engagement-icon">
                        <i class='bx bx-line-chart'></i>
                    </div>
                </section>
            </section>
        </section>
    </section>

</body>
</html>