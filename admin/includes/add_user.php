<?php

if(isset($_POST['create_user'])){
    $user_firstname  = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $username = $_POST['username'];
    $user_role = $_POST['user_role'];
    if($user_role == "") {
        $user_role = "subscriber";
    }
    $user_password = $_POST['user_password'];
    $user_status = "Pending";

    move_uploaded_file($user_image_temp, "../resources/img/$user_image");
    if($user_image == ""){
        $user_image = "user_default.png";
    }

    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, user_status) ";
    $query .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_role}','{$user_status}')  ";
    $create_user_query = mysqli_query($connection, $query);

    confirmQuery($create_user_query);
    header("Location: users.php");
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option disabled selected>Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>



    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
        <a class="btn btn-light" href="./users.php" role="button">Cancel</a>
    </div>

</form>