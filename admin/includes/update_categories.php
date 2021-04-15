<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Update Category</label>
<?php
// EDIT CATEGORY QUERY
if(isset($_GET['edit'])) {
    global $connection;
    $edit_cat_id = $_GET['edit'];
    $edit_query = "SELECT * FROM categories WHERE cat_id = {$edit_cat_id}";
    $edit_categories = mysqli_query($connection, $edit_query);

    while($row = mysqli_fetch_assoc($edit_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        ?>

        <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">

    <?php } } ?>
<?php
// UPDATE CATEGORY QUERY
if(isset($_POST['update_category'])) {
    global $connection;
    $update_cat_title = $_POST['cat_title'];
    $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = {$edit_cat_id}";
    $update_query = mysqli_query($connection, $query);
    if(!$update_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    header("Location: categories.php");
}
?>

            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
            </div>
        </form>
