<?php

if (isset($_GET['p_id'])) {
    $update_post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = {$update_post_id}";
$select_posts_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_banner_image = $row['post_banner_image'];
    $post_comment_count = $row['post_comment_count'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_status = $row['post_status'];

    $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
    $cat_title_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($cat_title_query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
    }

    if (isset($_POST['update_post'])) {
        $post_title = $_POST['post_title'];
        $post_title = mysqli_real_escape_string($connection, $post_title);
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_banner_image = $_FILES['post_banner_image']['name'];
        $post_banner_image_temp = $_FILES['post_banner_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_content = mysqli_real_escape_string($connection, $post_content);

        move_uploaded_file($post_image_temp, "../resources/img/$post_image");
        move_uploaded_file($post_banner_image_temp, "../resources/img/$post_banner_image");

        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = {$update_post_id} ";
            $select_image = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($select_image)) {
                $post_image = $row['post_image'];
            }
        }
        if (empty($post_banner_image)) {
            $query = "SELECT * FROM posts WHERE post_id = {$update_post_id} ";
            $select_banner_image = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($select_banner_image)) {
                $post_banner_image = $row['post_banner_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}', ";
        $query .= "post_banner_image = '{$post_banner_image}' ";
        $query .= "WHERE post_id = {$update_post_id} ";

        $update_post_query = mysqli_query($connection, $query);

        confirmQuery($update_post_query);

        header("Location: posts.php");
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="post_title">Post Title</label>
            <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
        </div>

        <div class="form-group">
            <label for="post_category">Post Category</label><br>
            <select name="post_category" id="post_category">
                <option selected value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
                <?php
                $edit_query = "SELECT * FROM categories ";
                $edit_categories = mysqli_query($connection, $edit_query);

                confirmQuery($edit_categories);

                while ($row = mysqli_fetch_assoc($edit_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="post_author">Post Author</label>
            <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
        </div>

        <div class="form-group">
            <label for="post_status">Post Status</label><br>
            <select name="post_status" id="post_status">
                <option disabled selected>Select Status</option>
                <?php
                if ($post_status == "Published") {
                    echo "<option value='Draft'>Draft</option>";
                    echo "<option value='Published' selected>Published</option>";
                } else {
                    echo "<option value='Draft' selected>Draft</option>";
                    echo "<option value='Published'>Published</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="post_image">Post Image</label><br>
            <?php if ($post_image != "") { ?>
                <img class="img-thumbnail" style="width:100px;height:auto;margin-bottom:5px;"
                     src="../resources/img/<?php echo $post_image; ?>">
            <?php } ?>
            <input type="file" name="post_image">
        </div>

        <div class="form-group">
            <label for="post_banner_image">Post Banner Image</label><br>
            <?php if ($post_banner_image != "") { ?>
                <img class="img-thumbnail" style="width:100px;height:auto;margin-bottom:5px;"
                     src="../resources/img/<?php echo $post_banner_image; ?>">
            <?php } ?>
            <input type="file" name="post_banner_image">
        </div>

        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
        </div>

        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea name="post_content" id="post_content" rows="10" cols="80"><?php echo $post_content; ?></textarea>
            <script>
                CKEDITOR.replace('post_content');
            </script>
            <!-- <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">--><!--</textarea>-->
        </div>


        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
            <a class="btn btn-light" href="./posts.php" role="button">Cancel</a>
        </div>

    </form>
<?php } ?>