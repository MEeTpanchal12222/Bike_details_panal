<?php
header("Content-Type: multipart/form-data");

$conn = new mysqli('localhost', 'root', '', 'bikes');

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST': // Add a new bike
        $data = json_decode(file_get_contents("php://input"), true);

        $name = $conn->real_escape_string($data['name']);
        $type = $conn->real_escape_string($data['type']);
        $mileage = $conn->real_escape_string($data['mileage']);
        $top_speed = $conn->real_escape_string($data['top_speed']);
        $engine_type = $conn->real_escape_string($data['engine_type']);
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageName = basename($_FILES['image']['name']);
            $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
            if (in_array(strtolower($imageExtension), $allowedExtensions)) {
                $imageNewName = uniqid('bike_', true) . '.' . $imageExtension;
                $uploadDir = 'D:/xampp/htdocs/Bike_details_panal/uploads/';
                $uploadFilePath = $uploadDir . $imageNewName;
    
                if (move_uploaded_file($imageTmpPath, $uploadFilePath)) {
                    $query = "INSERT INTO bikes (name, type, mileage, top_speed, engine_type, image) 
                              VALUES ('$name', '$type', '$mileage', '$top_speed', '$engine_type', '$imageNewName')";
    
                    if ($conn->query($query)) {
                        echo json_encode(["message" => "Bike added successfully"]);
                    } else {
                        echo json_encode(["error" => $conn->error]);
                    }
                } else {
                    echo json_encode(["error" => "Failed to upload image"]);
                }
            } else {
                echo json_encode(["error" => "Invalid image file type"]);
            }
        } else {
            echo json_encode(["error" => "Image file is required"]);
        }
        break;

    case 'GET': // Retrieve all or a single bike
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $query = "SELECT * FROM bikes WHERE id = $id";
        
        } else {
            $query = "SELECT * FROM bikes";
        }
        
        $result = $conn->query($query);
        $bikes = [];
        while ($row = $result->fetch_assoc()) {
            $bikes[] = $row;
        }
        echo json_encode($bikes);
        break;

    case 'DELETE': // Delete a bike
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $query = "DELETE FROM bikes WHERE id = $id";
            
            if ($conn->query($query)) {
                echo json_encode(["message" => "Bike deleted successfully"]);
            } else {
                echo json_encode(["error" => $conn->error]);
            }
        } else {
            echo json_encode(["error" => "ID not provided"]);
        }
        break;

    default:
        echo json_encode(["error" => "Invalid request method"]);
}

$conn->close();
?>
