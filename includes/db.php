<?php
// here we will create the DB connection
// we need mysqli_connect function for that

$db['db_host'] = "localhost";
$db['db_user'] = "";
$db['db_pass'] = "";
$db['db_name'] = "";

foreach($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($connection) {
    echo 'We have connection!';
}


?>