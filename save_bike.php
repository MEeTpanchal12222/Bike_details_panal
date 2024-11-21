<?php
$conn = new mysqli('localhost', 'root', '', 'bikes');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $name = $conn->real_escape_string($_POST['name']);
    $type = $conn->real_escape_string($_POST['type']);
    $mileage = $conn->real_escape_string($_POST['mileage']);
    $top_speed = $conn->real_escape_string($_POST['top_speed']);
    $engine_type = $conn->real_escape_string($_POST['engine_type']);
    $image_path = '';

    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $image_name = time() . "_" . basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = $target_file;
        }
    }

    if ($id) {
        $query = "UPDATE bikes SET 
                    name='$name', type='$type', mileage='$mileage', 
                    top_speed='$top_speed', engine_type='$engine_type'";
        if ($image_path) {
            $query .= ", image='$image_path'";
        }
        $query .= " WHERE id=$id";
    } else {
        $query = "INSERT INTO bikes (name, type, mileage, top_speed, engine_type, image) 
                  VALUES ('$name', '$type', '$mileage', '$top_speed', '$engine_type', '$image_path')";
    }

    if ($conn->query($query) === TRUE) {
        header("Location: bikes.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
