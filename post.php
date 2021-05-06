<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Site Navigation
?>

<?php
if (isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];
}

if (isset($_GET['delete'])) {
    $delete_comment_id = $_GET['delete'];
    $update_comment_count_id = $_GET['p_id'];
    $query = "DELETE FROM comments WHERE comment_id = {$delete_comment_id} ";
    $delete_query = mysqli_query($connection, $query);
    $query = "UPDATE posts SET post_comment_count = post_comment_count-1 ";
    $query .= "WHERE post_id = {$update_comment_count_id} ";
    $post_update_comment_count_query = mysqli_query($connection, $query);
    header("Location: post.php?p_id={$update_comment_count_id}");
}

$query = "SELECT * FROM posts WHERE post_id = $post_id";
$select_all_posts_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_banner_image = $row['post_banner_image'];
    $post_content = $row['post_content'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];

    if ($post_status == 'Published' || $user_role == 'admin') {

    ?>
    <section class="section-about" id="about">
        <div class="row">
            <?php

            if (empty($post_banner_image)) {
                echo "<img src='../resources/img/{$post_image}' alt='{$post_title}' class='blog-hero'>";
            } else {
                echo "<br><br><br><img src='../resources/img/{$post_banner_image}' alt='{$post_title}'  class='rectangle-hero'>";
            }

            ?>

        </div>
        <div class="row blog-post">
            <h2><?php echo $post_title; ?></h2>
            <?php
            if (isset($_SESSION['user_role'])) {
                $user_role = $_SESSION['user_role'];
                if ($user_role == 'admin') {
                    ?>
                    <small><a href="admin/posts.php?source=update_post&p_id=<?php echo $post_id; ?>">Edit
                            Post</a></small>
                <?php }
            } ?>
            <p style="text-align: right;"><small>by <?php echo $post_author; ?> | <?php echo date('D, M j Y', strtotime($post_date)); ?></small></p>
            <?php
            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
            $select_categories = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<p style='text-align:right;'><small>Category: <a href='category/{$cat_id}'>{$cat_title}</a></small></p>";
            }
            ?>
            <p style="min-height: 20px;">
                <?php echo $post_content; ?>
            </p>
            <br><br>
            <?php
            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
            $select_categories = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "Check out other <a href='category/{$cat_id}'>{$cat_title}</a> blogs.";
            }
            ?>
        </div>
    </section>

    <?php include "includes/comments.php"; ?>

    <?php } else ?> 
        <section class="section-about" id="about">
            <div class="row blog-post">
                <br><br><br>
                <h2>No blog post found</h2>
                <br><br>
            </div>
            <div class="row">
                <div class="col span-1-of-2">
                    <div class="card">
                        <div class="card-body">
                            <h4>Search All Blogs</h4><br>
                            <form action="search" method="post">
                                <div class="input-group">
                                    <input name="search" type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button name="submit" class="btn btn-default" type="submit"
                                                style="display:none;"></button>
                                    </span>
                                </div>
                            </form><!-- search form -->
                        </div>
                    </div>
                </div>
                <div class="col span-1-of-2">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $query = "SELECT * FROM categories";
                            $select_categories_sidebar = mysqli_query($connection, $query);
                            ?>
                            <h4>Categories</h4><br>
                            <?php
                            while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            ?>
                            <div class="col span-1-of-2"
                            <p style='margin-bottom:15px;'>
                                <a href='category/<?php echo $cat_id; ?>'><?php echo $cat_title; ?></a>
                            </p>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

<?php include "includes/blog_showcase.php"; ?>

<?php include "includes/contact.php"; ?>

<?php include "includes/footer.php"; ?>