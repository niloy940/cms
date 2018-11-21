<?php
/**
 * Created by IntelliJ IDEA.
 * User: niloy
 * Date: 11/7/18
 * Time: 3:39 PM
 */

session_start();

$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['user_role'] = null;

echo '<script>window.location.href = "../index.php";</script>';