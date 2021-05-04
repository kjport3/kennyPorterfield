<?php include "db.php"; ?>

<?php session_start(); ?>

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

    } elseif (email_exists($user_email)) {

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

        header("Location: ../");
    }
}



?>

