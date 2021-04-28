<section class="section-blogs js--section-blog" id="blog">
    <h2>Recent Blog Posts</h2>
    <ul class="blogs-showcase clearfix">
        <?php
        $query = "SELECT * FROM posts WHERE post_status = 'Published' AND post_category_id <> 9 ORDER BY post_id desc LIMIT 4";
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
            <li>
                <figure class="blog-photo container-blog blog">
                    <a href="post/<?php echo $post_id; ?>"><img src="resources/img/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>"></a>
                    <div class="centered-text hide"><a href="post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a></div>
                </figure>
            </li>
        <?php } ?>
    </ul>
    <ul class="blogs-showcase clearfix">
        <?php
        $query = "SELECT * FROM posts WHERE post_status = 'Published' ORDER BY post_id desc LIMIT 4 OFFSET 4";
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
            <li>
                <figure class="blog-photo container-blog blog">
                    <a href="post/<?php echo $post_id; ?>"><img src="resources/img/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>"></a>
                    <div class="centered-text hide"><a href="post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a></div>
                </figure>
            </li>
        <?php } ?>
    </ul>
</section>