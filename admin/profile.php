<?php include "includes/admin_header.php"; ?>

<?php
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
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
    }
}
?>

<?php
if(isset($_POST['update_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $username = $_POST['username'];
    $user_role = $_POST['user_role'];
    if ($user_role == "") {
        $user_role = "subscriber";
    }
    $user_password = $_POST['user_password'];
    $user_status = $user_status;

    move_uploaded_file($user_image_temp, "../images/$user_image");

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_id = {$user_id} ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {
            $user_image = $row['user_image'];
        }
    }

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_password = '{$user_password}', ";
    $query .= "user_status = '{$user_status}', ";
    $query .= "user_image = '{$user_image}' ";
    $query .= "WHERE username = '{$username}' ";

    $update_user_query = mysqli_query($connection, $query);

    confirmQuery($update_user_query);

    header("Location: users.php");
}
?>

<div id="wrapper">

    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Profile
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="user_firstname">Firstname</label>
                            <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">Lastname</label>
                            <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
                        </div>

                        <div class="form-group">
                            <select name="user_role" id="">
                                <option disabled>Select Options</option>
                                <?php if($user_role == "admin") {
                                    echo "<option selected value='admin'>Admin</option>";
                                } else {
                                    echo "<option value='admin'>Admin</option>";
                                }
                                if($user_role == "subscriber") {
                                    echo "<option selected value='subscriber'>Subscriber</option>";
                                } else {
                                    echo "<option value='subscriber'>Subscriber</option>";
                                } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_image">User Image</label><br>
                            <?php if($user_image != "") { ?>
                                <img class="img-thumbnail" style="width:100px;height:auto;margin-bottom:5px;" src="../resources/img/<?php echo $user_image; ?>">
                            <?php } ?>
                            <input type="file" name="user_image">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
                        </div>

                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
                        </div>

                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password">
                        </div>



                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_user" value="Update Profile">
                            <a class="btn btn-light" href="./" role="button">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>
