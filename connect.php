<?php
$user = 'root';
$password = 'root';
$db = 'ajaxdb';
$host = 'localhost';
$port = 3306;

$conn = mysqli_connect(
   "$host:$port",
   $user,
   $password,
   $db
);
