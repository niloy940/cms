<?php
/**
 * Created by IntelliJ IDEA.
 * User: niloy
 * Date: 11/2/18
 * Time: 8:03 AM
 */
?>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        </thead>

        <tbody>

        <?php
        $query = "select * from users";
        $select_user = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_user)) {

            $user_id = $row['user_id'];
            $user_name = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['role'];

            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$user_name}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>


        </tbody>
    </table>

<?php

if (isset($_GET['change_to_admin'])){
    $the_user_id = $_GET['change_to_admin'];

    $query = "update users set role = 'admin' where user_id = {$the_user_id}";
    $change_to_admin_query = mysqli_query($connection, $query);

    echo '<script>window.location.href = "users.php";</script>';
}

if (isset($_GET['change_to_sub'])){
    $the_user_id = $_GET['change_to_sub'];

    $query = "update users set role = 'subscriber' where user_id = {$the_user_id}";
    $change_to_sub_query = mysqli_query($connection, $query);

    echo '<script>window.location.href = "users.php";</script>';
}


if (isset($_GET['delete'])){
    $the_user_id = $_GET['delete'];

    $query = "delete from users where user_id = {$the_user_id}";
    $delete_query = mysqli_query($connection, $query);

    echo '<script>window.location.href = "users.php";</script>';
}

?>