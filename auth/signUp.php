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
                <h1>Sign Up</h1>
            </div>
            <form action="../includes/process.php" method="post">
                <div class="sign-input">
                    <label for="fname">FIRST NAME</label>
                    <input type="text" id="fname" name="fname" placeholder="Your first name">
                </div>
                <div class="sign-input">
                    <label for="lname">LAST NAME</label>
                    <input type="text" id="lname" name="lname" placeholder="Your last name">
                </div>
                <div class="sign-input">
                    <label for="u-email">EMAIL ADDRESS</label>
                    <input type="email" id="u-email" name="u_email" placeholder="Your account email">
                </div>
                <div class="sign-input">
                    <label for="u-password">PASSWORD</label>
                    <input type="password" id="u-password" name="u_pass" placeholder="Enter your secure password">
                </div>
                <div class="sign-up">
                    <a href="../auth/signIn.php">already have an account?</a>
                </div>
                <div class="sign-button">
                    <button type="submit" name="register">SIGN UP</button>
                </div>
            </form>
        </section>
    </section>
</body>
</html>