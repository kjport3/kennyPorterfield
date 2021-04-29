<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Navigation
?>


<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_role = $_SESSION['user_role'];
    if ($user_role == 'admin') {
        header("Location: admin/profile.php");
    } else {
        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_profile = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_user_profile)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_image = $row['user_image'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_status = $row['user_status'];

            ?>

            <?php
            if (isset($_POST['update_user'])) {
                $user_firstname = $_POST['user_firstname'];
                $user_lastname = $_POST['user_lastname'];
                $user_email = $_POST['user_email'];

                $user_image = $_FILES['user_image']['name'];
                $user_image_temp = $_FILES['user_image']['tmp_name'];

                $username = $_POST['username'];
                $user_role = $_POST['user_role'];
                $user_role = "subscriber";
                $user_password = $_POST['user_password'];

                move_uploaded_file($user_image_temp, "resources/img/$user_image");

                if (empty($user_image)) {
                    $query = "SELECT * FROM users WHERE user_id = {$user_id} ";
                    $select_image = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_array($select_image)) {
                        $user_image = $row['user_image'];
                    }
                }

                $username = mysqli_real_escape_string($connection, $username);
                $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
                $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
                $user_email = mysqli_real_escape_string($connection, $user_email);
                $user_password = mysqli_real_escape_string($connection, $user_password);

                if (!empty($user_password)) {
                    $query_password = "SELECT user_password FROM users WHERE user_id = $user_id ";
                    $get_user = mysqli_query($connection, $query_password);
                    $row = mysqli_fetch_array($get_user);
                    $db_user_password = $row['user_password'];

                    if ($db_user_password != $user_password) {
                        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
                    }
                }

                $query = "UPDATE users SET ";
                $query .= "user_firstname = '{$user_firstname}', ";
                $query .= "user_lastname = '{$user_lastname}', ";
                $query .= "user_email = '{$user_email}', ";
                $query .= "username = '{$username}', ";
                $query .= "user_role = '{$user_role}', ";
                $query .= "user_password = '{$user_password}', ";
                $query .= "user_image = '{$user_image}' ";
                $query .= "WHERE username = '{$username}' ";
                $update_user_query = mysqli_query($connection, $query);

                $_SESSION['username'] = $username;
                $_SESSION['firstname'] = $user_firstname;
                $_SESSION['lastname'] = $user_lastname;
                $_SESSION['user_role'] = $user_role;

                if (!$update_user_query) {
                    die("QUERY FAILED<br>" . mysqli_error($connection));
                }
            }
            ?>

            <br><br>
            <!-- Login -->
            <section class="section-about" id="about">
                <div class="row form-group" style="width: 50%;">
                    <h2>Edit Profile</h2>
                    <br>
                    <?php if (isset($_POST['update_user'])) {
                        echo "<h3 style='text-align: center;'>Profile updated!</h3><br><br>";
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="user_firstname">Firstname</label>
                            <input value="<?php echo $user_firstname; ?>" type="text" class="form-control"
                                   id="user_firstname" name="user_firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="user_lastname">Lastname</label>
                            <input value="<?php echo $user_lastname; ?>" type="text" class="form-control"
                                   id="user_lastname" name="user_lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="user_image">Profile Picture</label><br>
                            <?php if ($user_image != "") { ?>
                                <img class="img-thumbnail" style="width:100px;height:auto;margin-bottom:5px;"
                                     src="../resources/img/<?php echo $user_image; ?>">
                            <?php } ?>
                            <input type="file" name="user_image">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input value="<?php echo $user_email; ?>" type="text" class="form-control" id="user_email"
                                   name="user_email" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input value="<?php echo $username; ?>" type="text" class="form-control" id="username"
                                   name="username" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input value="<?php echo $user_password; ?>" type="password" class="form-control"
                                   id="user_password" name="user_password"
                                   required>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_user" value="Update Profile">
                            <a class="btn btn-ghost" href="./" role="button">Cancel</a>
                        </div>
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
        <?php }
    }
} ?>

<?php include "includes/footer.php"; ?>