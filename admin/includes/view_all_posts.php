<form action="" method="post">

<table class="table table-bordered table-hover">
    <div id="bulkOptionContainer" class="col-xs-4">
        <select class="form-control" name="" id="">
            <option disabled selected>Select Options</option>
            <option value="">Publish</option>
            <option value="">Draft</option>
            <option value="">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="./posts.php?source=add_post" role="button">Add Post</a>
        <br><br>
    </div>
    <thead>
    <tr>
        <th><input type="checkbox" id="selectAllBoxes"></th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id  = $row['post_category_id'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_comment_count = $row['post_comment_count'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];

        echo "<tr>";
        echo "<td><input type='checkbox' class='checkBoxes'></td>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td>{$post_title}</td>";

        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
        $select_categories = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<td>{$cat_title}</td>";
        }

        echo "<td>{$post_status}</td>";
        echo "<td><img class='img-thumbnail' style='width: 200px;height:auto;' src='../resources/img/{$post_image}' alt='{$post_image}' title='{$post_image}'></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comment_count}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td><a href='posts.php?source=update_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
    }
    ?>

    </tbody>
</table>
</form>
<?php

if(isset($_GET['delete'])){
    $delete_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}

?>