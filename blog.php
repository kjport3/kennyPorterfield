<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Site Navigation
?>
    <br><br>
    <section class="section-blog" id="about">
        <div class="row">
            <img src="../resources/img/blog-hero.jpg" alt="Hello" class="rectangle-hero">
        </div>
        <div class="row">
            <h2>Welcome to my blog</h2>
            <p class="blog-copy">
                These are my latest entries. You can also search or view by category to find older ones!
            </p>
        </div>
    </section>
    <section class="section-about" id="about">
        <div class="row">
            <?php
            $query = "SELECT * FROM posts WHERE post_status = 'Published' ORDER BY post_id desc LIMIT 15";
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
                $post_status = $row['post_status'];
                ?>
                <div class="col span-1-of-3">
                    <div class="row">
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><img
                                    src="../resources/img/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>"
                                    class="blog-thumbnail"></a>
                    </div>
                    <p class="long-copy" style="text-align: center;">
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?>
                            - <?php echo date('D, M j Y', strtotime($post_date)); ?></a>
                    </p>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col span-1-of-2">
                <div class="card">
                    <div class="card-body">
                        <h4>Search All Blogs</h4><br>
                        <form action="search.php" method="post">
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
                            <a href='category.php?category=<?php echo $cat_id; ?>'><?php echo $cat_title; ?></a>
                        </p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        </div>

    </section>

<?php include "includes/contact.php"; ?>

<?php include "includes/footer.php"; ?>