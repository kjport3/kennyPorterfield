<?php

if(isset($_POST['create_post'])){
    $post_title = $_POST['post_title'];
    $post_category_id  = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_banner_image = $_FILES['post_banner_image']['name'];
    $post_banner_image_temp = $_FILES['post_banner_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_content = mysqli_real_escape_string($connection, $post_content );

    $post_date = date('d-m-y');
    $post_comment_count = 0;

    move_uploaded_file($post_image_temp, "../resources/img/$post_image");
    move_uploaded_file($post_banner_image_temp, "../resources/img/$post_banner_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status, post_banner_image) ";
    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}','{$post_banner_image}')  ";
    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);
    header("Location: posts.php");
}

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label><br>
        <select name="post_category" id="post_category">
            <option disabled selected>Select Category</option>
            <?php
            $edit_query = "SELECT * FROM categories ";
            $edit_categories = mysqli_query($connection, $edit_query);

            confirmQuery($edit_categories);

            while($row = mysqli_fetch_assoc($edit_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="post_status">
            <option disabled selected>Select Status</option>
            <option value="Draft">Draft</option>
            <option value="Published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_banner_image">Post Banner Image</label>
        <input type="file" name="post_banner_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
        <a class="btn btn-light" href="posts.php" role="button">Cancel</a>
    </div>

</form>