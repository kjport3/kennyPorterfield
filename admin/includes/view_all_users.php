<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM users";
    $select_comments = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_comments)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email  = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_status = $row['user_status'];

        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td><img class='img-thumbnail' style='width: 150px;height:auto;' src='../resources/img/{$user_image}' alt='{$user_image}' title='{$user_image}'></td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_role}</td>";
        echo "<td>{$user_status}</td>";
        echo "<td><a href='users.php?approve_user={$user_id}'>Approve</a></td>";
        echo "<td><a href='users.php?deny_user={$user_id}'>Deny</a></td>";
        echo "<td><a href='users.php?source=update_user&u_id={$user_id}'>Edit</a></td>";
        echo "<td><a href='users.php?delete_user={$user_id}'>Delete</a></td>";
        echo "</tr>";
    }
    ?>

    </tbody>
</table>

<?php

if(isset($_GET['approve_user'])){
    $approve_user_id = $_GET['approve_user'];
    $query = "UPDATE users SET user_status = 'Approved' WHERE user_id = {$approve_user_id} ";
    $approve_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

if(isset($_GET['deny_user'])){
    $deny_user_id = $_GET['deny_user'];
    $query = "UPDATE users SET user_status = 'Denied' WHERE user_id = {$deny_user_id} ";
    $deny_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

if(isset($_GET['delete_user'])){
    $delete_user_id = $_GET['delete_user'];
    $query = "DELETE FROM users WHERE user_id = {$delete_user_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

?>