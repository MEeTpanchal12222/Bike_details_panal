<?php
header("Content-Type: application/json");

$conn = new mysqli('localhost', 'root', '', 'bikes');

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':

        $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : null;
        $type = isset($_POST['type']) ? $conn->real_escape_string($_POST['type']) : null;
        $mileage = isset($_POST['mileage']) ? $conn->real_escape_string($_POST['mileage']) : null;
        $top_speed = isset($_POST['top_speed']) ? $conn->real_escape_string($_POST['top_speed']) : null;
        $engine_type = isset($_POST['engine_type']) ? $conn->real_escape_string($_POST['engine_type']) : null;


        if (!$name || !$type || !$mileage || !$top_speed || !$engine_type) {
            echo json_encode(["error" => "All fields are required"]);
            exit;
        }


        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageName = basename($_FILES['image']['name']);
            $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (in_array(strtolower($imageExtension), $allowedExtensions)) {
                $imageNewName = uniqid('bike_', true) . '.' . $imageExtension;
                $uploadDir = __DIR__ . '/../uploads/';
                $uploadFilePath = $uploadDir . $imageNewName;

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                if (move_uploaded_file($imageTmpPath, $uploadFilePath)) {
                    $relativeFilePath = 'uploads/' . $imageNewName;

                    $query = "INSERT INTO bikes (name, type, mileage, top_speed, engine_type, image) 
                              VALUES ('$name', '$type', '$mileage', '$top_speed', '$engine_type', '$relativeFilePath')";

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

    case 'GET':

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


    case 'PUT':

        $inputData = json_decode(file_get_contents("php://input"), true);

        $id = isset($inputData['id']) ? intval($inputData['id']) : null;
        $name = isset($inputData['name']) ? $conn->real_escape_string($inputData['name']) : null;
        $type = isset($inputData['type']) ? $conn->real_escape_string($inputData['type']) : null;
        $mileage = isset($inputData['mileage']) ? $conn->real_escape_string($inputData['mileage']) : null;
        $top_speed = isset($inputData['top_speed']) ? $conn->real_escape_string($inputData['top_speed']) : null;
        $engine_type = isset($inputData['engine_type']) ? $conn->real_escape_string($inputData['engine_type']) : null;


        if (!$id || !$name || !$type || !$mileage || !$top_speed || !$engine_type) {
            echo json_encode(["error" => "All fields are required"]);
            exit;
        }


        $query = "UPDATE bikes SET 
                          name = '$name', 
                          type = '$type', 
                          mileage = '$mileage', 
                          top_speed = '$top_speed', 
                          engine_type = '$engine_type' 
                      WHERE id = $id";

        if ($conn->query($query)) {
            echo json_encode(["message" => "Bike updated successfully"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;


    case 'PATCH':
        $patchData = json_decode(file_get_contents("php://input"), true);
        $id = isset($patchData['id']) ? intval($patchData['id']) : null;

        if (!$id) {
            echo json_encode(["error" => "ID is required"]);
            exit;
        }

        $fields = [];
        foreach ($patchData as $key => $value) {
            if ($key !== 'id') {
                $fields[] = "$key = '" . $conn->real_escape_string($value) . "'";
            }
        }

        if (empty($fields)) {
            echo json_encode(["error" => "No fields to update"]);
            exit;
        }

        $query = "UPDATE bikes SET " . implode(', ', $fields) . " WHERE id = $id";

        if ($conn->query($query)) {
            echo json_encode(["message" => "Bike updated successfully"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
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
