<?php
header("Content-Type: application/json");
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $name = $data['name'];
    $type = $data['type'];
    $mileage = $data['mileage'];

    $query = "INSERT INTO bikes (name, type, mileage) VALUES ('$name', '$type', '$mileage')";
    if (mysqli_query($conn, $query)) {
        echo json_encode(["message" => "Record added successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . mysqli_error($conn)]);
    }
}
?>
