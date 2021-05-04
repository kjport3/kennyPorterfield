<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Navigation
?>

<?php

function username_exists($username){
    global $connection;
    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection,$query);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function email_exists($user_email){
    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email = '$user_email' ";
    $result = mysqli_query($connection,$query);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['create_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $username = $_POST['username'];
    $user_role = "subscriber";
    $user_password = $_POST['user_password'];
    $user_status = "Pending";

    if(username_exists($username)) {
        $errors = "Sorry, this username is taken.";
    } elseif (email_exists($user_email)) {
        $errors = "An account associated with this email already exists.";
    } else {
        move_uploaded_file($user_image_temp, "../resources/img/$user_image");
        if ($user_image == "") {
            $user_image = "user_default.png";
        }

        $username = mysqli_real_escape_string($connection, $username);
        $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
        $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
        $user_email = mysqli_real_escape_string($connection, $user_email);
        $user_password = mysqli_real_escape_string($connection, $user_password);

        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));



        $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, user_status) ";
        $query .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_role}','{$user_status}')  ";
        $create_user_query = mysqli_query($connection, $query);

        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $user_firstname;
        $_SESSION['lastname'] = $user_lastname;
        $_SESSION['user_role'] = $user_role;

        header("Location: ./");
    }
}

?>

    <br><br>
    <!-- Login -->
    <section class="section-about" id="about">
        <div class="row form-group" style="width: 50%;">
            <h2>Create an Account</h2>
            <br>
            <?php
            if ($errors) {
                echo "<br><div role='alert' style='color:red;'>{$errors}</div><br><br>";
            }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="user_firstname">Firstname</label>
                    <input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?php echo $user_firstname; ?>" required>
                </div>
                <div class="form-group">
                    <label for="user_lastname">Lastname</label>
                    <input type="text" class="form-control" id="user_lastname" name="user_lastname" value="<?php echo $user_lastname; ?>" required>
                </div>
                <div class="form-group">
                    <label for="user_image">Profile Picture</label><br>
                    <input type="file" name="user_image">
                </div>
                <div class="form-group">
                    <label for="user_email">Email</label>
                    <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $user_email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password" value="<?php echo $user_password; ?>" required>
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