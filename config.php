<?php

//defining constants to connect to database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'PMS');

//forming a connection object
 $conn =new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

//case of error while connecting to database
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>
