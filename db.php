<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artgallery_db";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>