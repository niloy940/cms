<?php
/**
 * Created by IntelliJ IDEA.
 * User: niloy
 * Date: 11/17/18
 * Time: 11:32 PM
 */

if (isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id'];
}

$query = "select * from posts where post_id = {$the_post_id}";
$select_post_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_post_by_id)) {

    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tag = $row['post_tag'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}
if (isset($_POST['update_post'])){
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_content = $_POST['post_content'];
    $post_tag = $_POST['post_tag'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)){
        $query = "select * from posts where post_id = {$the_post_id}";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)){
            $post_image = $row['post_image'];
        }
    }

    $query = "update posts set ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tag = '{$post_tag}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_date = now(), ";
    $query .= "post_content = '{$post_content}' ";
    $query .= "where post_id = {$the_post_id}";

    $update_post = mysqli_query($connection, $query);

    confirmQuery($update_post);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?= $post_title; ?>">
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?= $post_author; ?>">
    </div>

    <div class="form-group">
        <label for="post_category">Select Category</label><br>
        <select name="post_category">
            <?php
            $query = "select * from categories";
            $select_category = mysqli_query($connection, $query);
            confirmQuery($select_category);

            while ($row = mysqli_fetch_assoc($select_category)) {

                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?= $post_status; ?>">
    </div>

    <div class="form-group">
        <img src="../images/<?= $post_image; ?>" width="100" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tag">Post Tags</label>
        <input type="text" class="form-control" name="post_tag" value="<?= $post_tag; ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"><?= $post_content; ?>
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
</form>
