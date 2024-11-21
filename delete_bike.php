<?php
$conn = new mysqli('localhost', 'root', '', 'bikes');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM bikes WHERE id=$id");
}

header("Location: bikes.php");
$conn->close();
