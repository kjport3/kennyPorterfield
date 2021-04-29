<div class="row">
    <div class="col-md-12 col-lg-8">
        <h3><strong>Comments</strong></h3>
    </div>
</div>

<?php

if (!isset($_SESSION['username'])) {

    ?>
    <!-- Comments Form -->
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="well">
                <p><a href="login">Login</a> or <a href="signup">create an account</a> to leave a comment.
                </p>
            </div>
        </div>
    </div>
<?php } ?>

<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_role = $_SESSION['user_role'];


    if (isset($_POST['create_comment'])) {


        $post_id = $_GET['p_id'];
        $comment_author = $_POST['comment_author'];
        $comment_content = $_POST['comment_content'];
        $comment_status = 'Approved';
        if ($user_role == 'admin') {
            $comment_status = 'Approved';
        }
        $comment_content = mysqli_real_escape_string($connection, $comment_content);

        if (!empty($comment_content)) {
            $query = "INSERT INTO comments (comment_post_id, comment_date, comment_author, comment_content, comment_status) ";
            $query .= "VALUES ($post_id, now(), '$comment_author', '$comment_content', '$comment_status')";
            $comment_query = mysqli_query($connection, $query);
            if (!$comment_query) {
                die("QUERY FAILED<br>" . mysqli_error($connection));
            }

            $query = "UPDATE posts SET post_comment_count = post_comment_count+1 ";
            $query .= "WHERE post_id = {$post_id} ";
            $post_update_comment_count_query = mysqli_query($connection, $query);
            if (!$post_update_comment_count_query) {
                die("QUERY FAILED<br>" . mysqli_error($connection));
            }
        } else {
            echo "<script>alert('Comment field cannot be empty.')</script>";
        }

    }
    ?>
    <!-- Comments Form -->
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="well">
                <h4>Leave a Comment:</h4><br>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" name="comment_author" class="form-control" readonly
                               value="<?php echo $username; ?>">
                    </div>
                    <div class="form-group">
                        <label for="Comment">Comment</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Posted Comments -->
<?php
if (isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];
    $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
    $query .= "AND comment_status = 'Approved' ";
    $query .= "ORDER BY comment_id asc ";
    $find_post_comments = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($find_post_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        $query = "SELECT * FROM users WHERE username = '{$comment_author}' ";
        $profile_picture_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($profile_picture_query)) {
            $profile_thumbnail = $row['user_image'];
        }
        ?>

        <!-- Posted Comments -->
        <div class="row" id="comments">
            <div class="col-md-12">
                <div class="media">
                        <span class="pull-left">
                            <img class="media-object" src="resources/img/<?php echo $profile_thumbnail; ?>" alt="">
                        </span>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            - <small><?php echo date('M j Y', strtotime($comment_date)); ?></small> <?php
                            if (isset($_SESSION['username'])) {
                                $username = $_SESSION['username'];
                                if ($username == $comment_author) {
                                    echo "<span style='float: right; font-weight: 300; text-decoration: none;'><a href='post.php?delete={$comment_id}&p_id={$comment_post_id}' style='border: none;' class='comment-delete'>Delete</a></span>";
                                }
                            }
                            ?>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    <?php }
} ?>