<?php
    include '../includes/header.php';
?>

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

<?php
    include '../includes/footer.php';
?>