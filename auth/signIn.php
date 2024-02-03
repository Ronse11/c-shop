<?php 
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>c.Shop</title>

    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>
    <section class="sign-content">
        <section class="sign-box">
            <div class="sign-name">
                <h1>Sign In</h1>
            </div>
            <form action="../includes/process.php" method="post">
                <div class="sign-input">
                    <label for="u-email">EMAIL ADDRESS</label>
                    <input type="email" id="u-email" name="u_email" placeholder="Your email account" autocomplete="email">
                </div>
                <div class="sign-input">
                    <label for="u_pass">PASSWORD</label>
                    <input type="password" id="u_pass" name="u_pass" placeholder="Enter your secure password" autocomplete="current-password">
                </div>
                <div class="sign-up">
                    <a href="../auth/signUp.php">don't have an account?</a>
                </div>
                <div class="sign-button">
                    <button type="submit" name="login">SIGN IN</button>
                </div>
            </form>
        </section>
    </section>
</body>
</html>