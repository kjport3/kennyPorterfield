<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Navigation
?>
    <br><br>

<?php

if(isset($_POST['create_user'])){
    $user_firstname  = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $username = $_POST['username'];
    $user_role = "subscriber";
    $user_password = $_POST['user_password'];
    $user_status = "Pending";

    move_uploaded_file($user_image_temp, "../resources/img/$user_image");
    if($user_image == ""){
        $user_image = "user_default.png";
    }

    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, user_status) ";
    $query .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_role}','{$user_status}')  ";
    $create_user_query = mysqli_query($connection, $query);

    confirmQuery($create_user_query);
//    header("Location: profile.php");
}

?>
    <!-- Login -->
    <section class="section-about" id="about">
        <div class="row form-group" style="width: 50%;">
            <h2>Create an Account</h2>
            <br>
            <form action="" method="post">
                <div class="form-group">
                    <label for="user_firstname">Firstname</label>
                    <input type="text" class="form-control" id="user_firstname" name="user_firstname" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="user_lastname">Lastname</label>
                    <input type="text" class="form-control" id="user_lastname" name="user_lastname" placeholder="Lastname">
                </div>
                <div class="form-group">
                    <label for="user_image">User Image</label><br>
                    <input type="file" name="user_image">
                </div>
                <div class="form-group">
                    <label for="user_email">Email</label>
                    <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
                </div>
                <button type="submit" name="create_user" class="btn">Login</button>
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