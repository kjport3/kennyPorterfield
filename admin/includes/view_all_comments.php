<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Post Title</th>
        <th>Author</th>
        <th>Content</th>
        <th>Date</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM comments ORDER BY comment_id desc";
    $select_comments = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content  = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        echo "<tr>";
        echo "<td>{$comment_id}</td>";

        $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
        $select_post = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_post)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];

            echo "<td>{$post_title}</td>";
        }

        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_date}</td>";
        echo "<td>{$comment_status}</td>";
        echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
        echo "<td><a href='comments.php?deny={$comment_id}'>Deny</a></td>";
        echo "<td><a href='comments.php?delete={$comment_id}&p_id={$comment_post_id}'>Delete</a></td>";
        echo "</tr>";
    }
    ?>

    </tbody>
</table>

<?php

if(isset($_GET['approve'])){
    $approve_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$approve_comment_id} ";
    $approve_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if(isset($_GET['deny'])){
    $deny_comment_id = $_GET['deny'];
    $query = "UPDATE comments SET comment_status = 'Denied' WHERE comment_id = {$deny_comment_id} ";
    $deny_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if(isset($_GET['delete'])){
    $delete_comment_id = $_GET['delete'];
    $update_comment_count_id = $_GET['p_id'];
    $query = "DELETE FROM comments WHERE comment_id = {$delete_comment_id} ";
    $delete_query = mysqli_query($connection, $query);
    $query = "UPDATE posts SET post_comment_count = post_comment_count-1 ";
    $query .= "WHERE post_id = {$update_comment_count_id} ";
    $post_update_comment_count_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

?>