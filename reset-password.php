<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Navigation
?>

<?php
if (isset($_GET['email']) && isset($_GET['token'])) {
    $user_email = $_GET['email'];
    $token = $_GET['token'];

    $query = "SELECT * FROM users WHERE token = '{$token}' ";
    $select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query) {
        die("QUERY FAILED " . mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query)) {
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

        if (isset($_POST['reset'])) {
            $password = $_POST['user_password'];
            $password_verify = $_POST['user_password_verify'];

            if ($password == $password_verify) {
                $user_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                $query = "UPDATE users SET ";
                $query .= "user_password = '{$user_password}' ";
                $query .= "WHERE username = '{$db_username}' ";
                $update_user_query = mysqli_query($connection, $query);

                $_SESSION['username'] = $db_username;
                $_SESSION['firstname'] = $db_firstname;
                $_SESSION['lastname'] = $db_lastname;
                $_SESSION['user_role'] = $db_user_role;

                header("Location: ./");
            } else {
                $errors = "\nThe two passwords need to match.";
            }
        }
    }

} else {
    header("Location: ./");
}
?>
    <br><br><br>
    <!-- Login -->
    <section class="section-about" id="about">
        <div class="row form-group" style="width: 50%;">
            <h2>Reset password</h2>
            <br>
            <?php
            if ($errors) {
                echo "<br><div role='alert' style='color:red;'>{$errors}</div><br><br>";
            }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">New password:</label>
                    <input type="password" class="form-control" id="user_password" name="user_password" required>
                </div>
                <div class="form-group">
                    <label for="username">Verify password:</label>
                    <input type="password" class="form-control" id="user_password_verify" name="user_password_verify" required>
                </div>
                <button type="submit" name="reset" class="btn">Reset Password</button>
            </form><!-- login form -->
        </div>
    </section>

<?php include "includes/blog_showcase.php"; ?>

<?php include "includes/contact.php"; ?>

<?php include "includes/footer.php"; ?>