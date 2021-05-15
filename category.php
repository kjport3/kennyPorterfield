<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Site Navigation
?>
    <br><br>
    <section class="section-about" id="about">
        <div class="row">
            <?php
            if (isset($_GET['category'])) {
                $cat_id = $_GET['category'];
                $query = "SELECT cat_title FROM categories WHERE cat_id = {$cat_id}";
                $cat_title_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($cat_title_query)) {
                    $cat_title = $row['cat_title'];
                    echo "<h2>$cat_title</h2>";
                }

                $query = "SELECT * FROM posts WHERE post_category_id = $cat_id AND post_status = 'Published' ORDER BY post_date desc";
                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    if (strlen($post_content) > 200) {
                        $post_content = substr($post_content, 0, 200) . '...';
                    }
                    $post_id = $row['post_id'];
                    ?>

                    <div class="row">
                        <a href="post/<?php echo $post_id; ?>"><img src="../resources/img/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>" class="blog-hero"></a>
                    </div>
                    <p class="result-title">
                        <a href="post/<?php echo $post_id; ?>"><?php echo $post_title; ?>
                            - <?php echo date('D, M j Y', strtotime($post_date)); ?></a>
                    </p>
                    <br><br>
                    <hr style="width: 60%; margin-left:20%;">

                    <?php
                }
            }
            ?>
        </div>

    </section>
<?php include "includes/blog_showcase.php"; ?>

<?php include "includes/contact.php"; ?>

<?php include "includes/footer.php"; ?>
