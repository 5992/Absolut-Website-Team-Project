<?php
$host = getenv("dbhost");
$user = getenv("dbuser");
$password = getenv("dbpassword");
$database = getenv("dbname");
$connection = mysqli_connect($host,$user,$password,$database);
?>