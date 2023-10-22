<?php
session_start();
require_once "dbconfig.php";

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM employeetbl WHERE id='{$id}'";
    $result = $conn->query($sql);
    if ($result) {
        $_SESSION['response'] = 'Record is deleted successfully';
        header('location: index.php');
    } else {
        echo 'Error: ' . $sql . $conn->connect_error;
    }
}
