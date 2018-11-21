<?php
/**
 * Created by IntelliJ IDEA.
 * User: niloy
 * Date: 11/4/18
 * Time: 10:06 AM
 */

include ('db.php');

session_start();

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //preventing sql injuction
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "select * from users where username = '{$username}'";

    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query){
        die("Query Failed! ".mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($select_user_query)){
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['role'];
    }

    if ($username !== $db_username || $password !== $db_user_password){
        echo '<script>window.location.href = "../index.php";</script>';
    } elseif ($username === $db_username && $password === $db_user_password){

        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        echo '<script>window.location.href = "../admin";</script>';
    } else {
        echo '<script>window.location.href = "../index.php";</script>';
    }
}

