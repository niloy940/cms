<?php
/**
 * Created by IntelliJ IDEA.
 * User: niloy
 * Date: 10/9/18
 * Time: 4:47 PM
 */

$db['db_host'] = 'localhost';
$db['db_user'] = 'niloy';
$db['db_pass'] = 'niloy940';
$db['db_name'] = 'cms';

foreach ($db as $key => $value){
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

/*if ($connection) {
    echo "We are connected!";
}*/