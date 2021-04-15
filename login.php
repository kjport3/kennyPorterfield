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
            <form action="includes/login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" name="login" style="border-radius: 0.25rem;" class="btn btn-primary">Login</button>
                <?php
                if (isset($_GET['login'])) {
                    $login_valid = $_GET['login'];
                    if ($login_valid == "invalid") {
                        echo "<br><div class='alert alert-danger' role='alert'>This login is invalid.</div>";
                    }
                }
                ?>
            </form><!-- login form -->
            <br>
            <h4>Or</h4>
            <br>
            <a class="btn btn-primary" style="color:#FFFFFF;" href="signup.php" role="button">Create an Account</a>
        </div>
    </section>

<?php include "includes/blog_showcase.php"; ?>

<?php include "includes/contact.php"; ?>

<?php include "includes/footer.php"; ?>