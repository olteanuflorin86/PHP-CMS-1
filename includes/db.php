<?php

// here we will create the DB connection
// we need mysqli_connect function for that

//$connection = mysqli_connect('localhost', 'root', 'root', 'php-cms-1', '3306');
// we can skip 3306 if this is the port. But we have to put the password (root for phpMyAdmin)

$db['db_host'] = "localhost";
$db['db_user'] = "root"; 
$db['db_pass'] = "root";
$db['db_name'] = "php-cms-1";

foreach($db as $key => $value) {
    define(strtoupper($key), $value);
}


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

/*
if($connection) {
    echo 'We have connection!';
}
*/



?>