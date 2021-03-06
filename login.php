<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Navigation
?>
    <br><br><br>
    <!-- Login -->
    <section class="section-about" id="about">
        <div class="row form-group" style="width: 50%;">
            <h2>Login</h2>
            <br>
            <?php
            if (isset($_GET['login'])) {
                $login_valid = $_GET['login'];
                if ($login_valid == "invalid") {
                    echo "<br><div class='alert alert-danger' style='color:red;' role='alert'>You have entered an invalid username or password.</div><br><br>";
                }
            }
            ?>
            <form action="includes/login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="">
                </div>
                <button type="submit" name="login" class="btn">Login</button>
            </form><!-- login form -->
            <br>
            <p>Or</p>
            <br>
            <a class="btn btn-ghost" href="signup" role="button">Create an Account</a>
            <br><br>
            <a href="forgot-password" style="border:0;">Forgot password?</a>
        </div>
    </section>

<?php include "includes/blog_showcase.php"; ?>

<?php include "includes/contact.php"; ?>

<?php include "includes/footer.php"; ?>