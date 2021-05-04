<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Navigation
?>

<?php
if (isset($_POST['user_email'])) {
    $user_email = $_POST['user_email'];
    $errors = '';
    $myemail = 'kjport3@gmail.com';

    $query = "SELECT username FROM users WHERE user_email =  '{$user_email}' ";
    $check_email_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($check_email_query);
    $username = $row['username'];
    if(empty($username)) {
        $errors = "\n A user is not associated with that email.";
    } else {

        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));

        $query = "UPDATE users SET token = '{$token}' WHERE user_email =  '{$user_email}' ";
        $update_token_query = mysqli_query($connection, $query);

        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $user_email)) {
            $errors .= "\n Error: Invalid email address";
        }

        

        if( empty($errors)) {
            
            $to = $user_email; 
            $email_subject = "Password Recovery";
            $email_body = "Click here to reset your password.\n\nhttp://www.kennyporterfield.com/reset-password.php?email={$user_email}&token={$token}"; 
            
            $headers = "From: $myemail\n"; 
            $headers .= "Reply-To: $myemail";
            
            mail($to,$email_subject,$email_body,$headers);
        } 
    }
}
?>
    <br><br><br>
    <!-- Login -->
    <section class="section-about" id="about">
        <div class="row form-group" style="width: 50%;">
            <h2>Forgot password?</h2>
            <br>
            <?php
            if (isset($_POST['user_email']) && empty($errors)) {
                echo "<br><div role='alert'>You should receive an email shortly with a link to reset your password.</div><br>{$errors}<br>";
            } 
            if ($errors) {
                echo "<br><div role='alert' style='color:red;'>{$errors}</div><br><br>";
            }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Enter the email associated with your user</label>
                    <input type="text" class="form-control" id="user_email" name="user_email" required>
                </div>
                <button type="submit" name="recover" class="btn">Recover Password</button>
            </form><!-- login form -->
        </div>
    </section>

<?php include "includes/blog_showcase.php"; ?>

<?php include "includes/contact.php"; ?>

<?php include "includes/footer.php"; ?>