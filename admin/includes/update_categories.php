
<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Category Title</label>

        <?php
        if (isset($_GET['edit'])) {

            $cat_id = $_GET['edit'];

            $query = "select * from categories where cat_id = $cat_id ";
            $select_category_id = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_category_id)) {

                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                ?>

                <input value="<?php if (isset($cat_title)) {
                    echo $cat_title;
                } ?>" type="text" name="cat_title" class="form-control">
                <?php
            }
        }

        ?>


        <?php
        if (isset($_POST['update_cat'])) {
            $the_cat_title = $_POST['cat_title'];

            $query = "update categories set cat_title = '{$the_cat_title}' where cat_id = $cat_id";
            $update_query = mysqli_query($connection, $query);

            if (!$update_query) {
                die('Query Failed! ' . mysqli_error($connection));
            }

            echo '<script>window.location.href = "categories.php";</script>';
        }
        ?>


    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_cat" value="Update Category">
    </div>
</form>