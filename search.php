<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Site Navigation
?>
    <br><br>
    <section class="section-blog" id="about">
        <div class="row">
            <h2>Blog Search Results</h2>
        </div>
    </section>
    <section class="section-about" id="about">
        <div class="row search">
            <?php


            if (isset($_POST['submit'])) {
                $search = $_POST['search'];

                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'Published' ORDER BY post_id desc";
                $search_query = mysqli_query($connection, $query);
                if (!$search_query) {
                    die("Query failed" . mysqli_error($connection));
                }
                $count = mysqli_num_rows($search_query);
                if ($count == 0) {
                    ?>
                    <h1>No posts match that search, please try again</h1><br>
                    <div class="card" style="max-width: 600px; margin: auto;">
                        <div class="card-body">
                            <h4>Search All Blogs</h4><br>
                            <form action="search" method="post">
                                <div class="input-group">
                                    <input name="search" type="text" class="form-control">
                                    <span class="input-group-btn">
                                    <button name="submit" class="btn btn-default" type="submit" style="display:none;"></button>
                                </span>
                                </div>
                            </form><!-- search form -->
                        </div>
                    </div>
            <?php

                } else {
                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_id = $row['post_id'];
                        ?>

                        <div class="row">
                            <a href="post/<?php echo $post_id; ?>"><img src="../resources/img/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>" class="blog-hero"></a>
                        </div>
                        <p class="result-title">
                            <a href="post/<?php echo $post_id; ?>" style="text-decoration:none;"><?php echo $post_title; ?>
                                - <?php echo date('D, M j Y', strtotime($post_date)); ?></a>
                        </p>
                        <br><br>
                        <hr style="width: 60%; margin-left:20%;">

                        <?php
                    }
                }
            }
            ?>
        </div>

    </section>
<?php include "includes/blog_showcase.php"; ?>

<?php include "includes/contact.php"; ?>

<?php include "includes/footer.php"; ?>