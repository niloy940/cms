<?php
/**
 * Created by IntelliJ IDEA.
 * User: niloy
 * Date: 10/10/18
 * Time: 2:49 PM
 */


function confirmQuery($result){
    global $connection;

    if(!$result){
        die('Query Failed! '.mysqli_error($connection));
    }
}

function insert_categories()
{
    global $connection;

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty!";
        } else {
            $query = "insert into categories(cat_title) ";
            $query .= "value('{$cat_title}') ";

            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die('Query failed!' . mysqli_error($connection));
            }
        }
    }

}


function find_all_categories()
{
    global $connection;

    $query = "select * from categories";
    $select_category = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_category)) {

        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}


function delete_categories()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];

        $query = "delete from categories where cat_id = $the_cat_id";
        $delete_query = mysqli_query($connection, $query);

        echo '<script>window.location.href = "categories.php";</script>';
    }
}