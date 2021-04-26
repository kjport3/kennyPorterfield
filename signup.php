<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Navigation
?>

    <br><br>
    <!-- Login -->
    <section class="section-about" id="about">
        <div class="row form-group" style="width: 50%;">
            <h2>Create an Account</h2>
            <br>
            <form action="includes/signup.php" method="post">
                <div class="form-group">
                    <label for="user_firstname">Firstname</label>
                    <input type="text" class="form-control" id="user_firstname" name="user_firstname" required>
                </div>
                <div class="form-group">
                    <label for="user_lastname">Lastname</label>
                    <input type="text" class="form-control" id="user_lastname" name="user_lastname" required>
                </div>
                <div class="form-group">
                    <label for="user_image">Profile Picture</label><br>
                    <input type="file" name="user_image">
                </div>
                <div class="form-group">
                    <label for="user_email">Email</label>
                    <input type="text" class="form-control" id="user_email" name="user_email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password" required>
                </div>
                <button type="submit" name="create_user" class="btn">Create an Account</button>
                <?php
                if (isset($_GET['login'])) {
                    $login_valid = $_GET['login'];
                    if ($login_valid == "invalid") {
                        echo "<br><div class='alert alert-danger' role='alert'>This login is invalid.</div>";
                    }
                }
                ?>
            </form><!-- login form -->
        </div>
    </section>
    <br>

<?php include "includes/footer.php"; ?>