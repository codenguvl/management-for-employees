<?php

$host = 'localhost';
$dbname = 'quanli';
$username = 'root';
$password = '';


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Kết nối database thất bại: " . $conn->connect_error);
}


?>