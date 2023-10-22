<?php
$host = "localhost";
$username = "root";
$pass = "";
$dbname = "test";

$conn  = new mysqli($host, $username, $pass, $dbname);
if ($conn->connect_error) {
    die("Error connection: " . $conn->error);
} else {
    // echo "Database connection is successful";
}
